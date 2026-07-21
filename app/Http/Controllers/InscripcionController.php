<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with([
            'asistente',
            'curso'
        ])
            ->orderByDesc('fecha_registro')
            ->get();

        return view(
            'inscripciones.index',
            compact('inscripciones')
        );
    }

    public function create()
    {
        $cursos = Curso::orderBy('nombre')->get();

        return view(
            'inscripciones.create',
            compact('cursos')
        );
    }

    public function store(Request $request)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:150',
        'correo' => 'required|email|max:150',
        'telefono' => 'nullable|string|max:20',
        'id_curso' => 'required|exists:cursos,id_curso',
        'estado' => 'required|in:confirmada,pendiente,cancelada',
    ]);

    $asistenteExistente = Asistente::where(
        'correo',
        $datos['correo']
    )->first();

    /*
    |--------------------------------------------------------------------------
    | Comprobar duplicidad antes de modificar datos
    |--------------------------------------------------------------------------
    */

    if ($asistenteExistente) {
        $duplicada = Inscripcion::where(
            'id_asistente',
            $asistenteExistente->id_asistente
        )
            ->where('id_curso', $datos['id_curso'])
            ->exists();

        if ($duplicada) {
            return back()
                ->withInput()
                ->withErrors([
                    'correo' =>
                        'Este asistente ya está inscrito en el curso seleccionado.'
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Crear asistente o actualizarlo solo si la inscripción es válida
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use (
        $datos,
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

        Inscripcion::create([
            'id_asistente' => $asistente->id_asistente,
            'id_curso' => $datos['id_curso'],
            'estado' => $datos['estado'],
        ]);
    });

    return redirect()
        ->route('inscripciones.index')
        ->with(
            'success',
            'Inscripción registrada correctamente.'
        );
}

    public function edit(Inscripcion $inscripcion)
    {
        $inscripcion->load('asistente');

        $cursos = Curso::orderBy('nombre')->get();

        return view(
            'inscripciones.edit',
            compact('inscripcion', 'cursos')
        );
    }

    public function update(
        Request $request,
        Inscripcion $inscripcion
    ) {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'correo' => 'required|email|max:150',
            'telefono' => 'nullable|string|max:20',
            'id_curso' => 'required|exists:cursos,id_curso',
            'estado' => 'required|in:confirmada,pendiente,cancelada',
        ]);

        $asistenteConCorreo = Asistente::where(
            'correo',
            $datos['correo']
        )
            ->where(
                'id_asistente',
                '!=',
                $inscripcion->id_asistente
            )
            ->first();

        if ($asistenteConCorreo) {
            return back()
                ->withInput()
                ->withErrors([
                    'correo' =>
                        'El correo pertenece a otro asistente registrado.'
                ]);
        }

        $duplicada = Inscripcion::where(
            'id_asistente',
            $inscripcion->id_asistente
        )
            ->where('id_curso', $datos['id_curso'])
            ->where(
                'id_inscripcion',
                '!=',
                $inscripcion->id_inscripcion
            )
            ->exists();

        if ($duplicada) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_curso' =>
                        'El asistente ya tiene una inscripción en ese curso.'
                ]);
        }

        DB::transaction(function () use ($datos, $inscripcion) {
            $inscripcion->asistente->update([
                'nombre' => $datos['nombre'],
                'correo' => $datos['correo'],
                'telefono' => $datos['telefono'] ?? null,
            ]);

            $inscripcion->update([
                'id_curso' => $datos['id_curso'],
                'estado' => $datos['estado'],
            ]);
        });

        return redirect()
            ->route('inscripciones.index')
            ->with(
                'success',
                'Inscripción actualizada correctamente.'
            );
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();

        return redirect()
            ->route('inscripciones.index')
            ->with(
                'success',
                'Inscripción eliminada correctamente.'
            );
    }
}