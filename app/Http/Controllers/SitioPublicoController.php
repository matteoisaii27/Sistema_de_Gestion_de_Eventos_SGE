<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmacionInscripcionMail;
use App\Models\Asistente;
use App\Models\Configuracion;
use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\ProgramacionCurso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SitioPublicoController extends Controller
{
    public function inicio()
{
    $proximosCursos = Curso::where('estado', 'activo')
        ->whereDate('fecha_inicio', '>', now()->toDateString())
        ->orderBy('fecha_inicio')
        ->limit(3)
        ->get();

    return view(
        'publico.inicio',
        compact('proximosCursos')
    );
}

    public function cursos()
{
    $cursos = Curso::where('estado', 'activo')
        ->whereDate('fecha_inicio', '>', now()->toDateString())
        ->orderBy('fecha_inicio')
        ->get();

    return view(
        'publico.cursos',
        compact('cursos')
    );
}

    public function detalle(Curso $curso)
    {
        $curso->load([
            'programaciones' => function ($consulta) {
                $consulta
                    ->orderBy('fecha')
                    ->orderBy('hora_inicio');
            }
        ]);

        return view(
            'publico.detalle',
            compact('curso')
        );
    }

    public function calendario()
{
    $programaciones = ProgramacionCurso::with('curso')
        ->whereDate('fecha', '>=', now()->toDateString())
        ->whereHas('curso', function ($consulta) {
            $consulta->where('estado', 'activo');
        })
        ->orderBy('fecha')
        ->orderBy('hora_inicio')
        ->get();

    return view(
        'publico.calendario',
        compact('programaciones')
    );
}

    public function mostrarInscripcion(Curso $curso)
{
    if (
        $curso->estado !== 'activo' ||
        !$curso->fecha_inicio ||
        now()->startOfDay()->greaterThanOrEqualTo(
            \Carbon\Carbon::parse($curso->fecha_inicio)->startOfDay()
        )
    ) {
        abort(404);
    }

    $configuracion = Configuracion::first();

    $inscripcionesHabilitadas =
        $configuracion?->inscripciones_habilitadas ?? true;

    $inscritosConfirmados = Inscripcion::where(
        'id_curso',
        $curso->id_curso
    )
        ->where('estado', 'confirmada')
        ->count();

    $lugaresDisponibles = max(
        0,
        $curso->cupo_maximo - $inscritosConfirmados
    );

    return view(
        'publico.inscripcion',
        compact(
            'curso',
            'inscripcionesHabilitadas',
            'lugaresDisponibles'
        )
    );
}

public function guardarInscripcion(
    Request $request,
    Curso $curso
) {
    if ($curso->estado !== 'activo') {
        abort(404);
    }

     if (
        !$curso->fecha_inicio ||
        now()->startOfDay()->greaterThanOrEqualTo(
            Carbon::parse($curso->fecha_inicio)->startOfDay()
        )
    ) {
        return redirect()
            ->route('publico.detalle', $curso)
            ->withErrors([
                'inscripcion' =>
                    'Las inscripciones para este curso ya finalizaron.'
            ]);
    }

    $configuracion = Configuracion::first();

    if (
        $configuracion &&
        !$configuracion->inscripciones_habilitadas
    ) {
        return back()->withErrors([
            'inscripcion' =>
                'Las inscripciones se encuentran temporalmente deshabilitadas.'
        ]);
    }

    $datos = $request->validate([
        'nombre' => 'required|string|max:150',
        'correo' => 'required|email|max:150',
        'correo_confirmation' => 'required|same:correo',
        'telefono' => 'nullable|string|max:20',
    ]);

    $inscritosConfirmados = Inscripcion::where(
        'id_curso',
        $curso->id_curso
    )
        ->where('estado', 'confirmada')
        ->count();

    if ($inscritosConfirmados >= $curso->cupo_maximo) {
        return back()
            ->withInput()
            ->withErrors([
                'inscripcion' =>
                    'El curso ya alcanzó su cupo máximo.'
            ]);
    }

    $asistenteExistente = Asistente::where(
        'correo',
        $datos['correo']
    )->first();

    if ($asistenteExistente) {
        $duplicada = Inscripcion::where(
            'id_asistente',
            $asistenteExistente->id_asistente
        )
            ->where('id_curso', $curso->id_curso)
            ->exists();

        if ($duplicada) {
            return back()
                ->withInput()
                ->withErrors([
                    'correo' =>
                        'Ya existe una inscripción con este correo para el curso seleccionado.'
                ]);
        }
    }

    $inscripcion = DB::transaction(function () use (
    $datos,
    $curso,
    $asistenteExistente
) {
    if ($asistenteExistente) {
        $asistenteExistente->update([
            'nombre' => $datos['nombre'],
            'telefono' => $datos['telefono'] ?? null,
        ]);

        $asistente = $asistenteExistente;
    } else {
        $asistente = Asistente::create([
            'nombre' => $datos['nombre'],
            'correo' => $datos['correo'],
            'telefono' => $datos['telefono'] ?? null,
        ]);
    }

    return Inscripcion::create([
        'id_asistente' => $asistente->id_asistente,
        'id_curso' => $curso->id_curso,
        'estado' => 'confirmada',
    ]);
});

$inscripcion->load([
    'asistente',
    'curso.programaciones',
]);

Mail::to($inscripcion->asistente->correo)
    ->send(new ConfirmacionInscripcionMail($inscripcion));

return redirect()->route(
    'publico.confirmacion',
    $inscripcion
);
}

public function confirmacion(Inscripcion $inscripcion)
{
    $inscripcion->load([
        'asistente',
        'curso',
    ]);

    return view(
        'publico.confirmacion',
        compact('inscripcion')
    );
}
}