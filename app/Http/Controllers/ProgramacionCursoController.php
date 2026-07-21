<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\ProgramacionCurso;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProgramacionCursoController extends Controller
{
    public function index()
    {
        $programaciones = ProgramacionCurso::with('curso')
            ->orderByDesc('fecha')
            ->orderByDesc('hora_inicio')
            ->get();

        return view(
            'programaciones.index',
            compact('programaciones')
        );
    }

    public function create()
    {
        $cursos = Curso::withCount('programaciones')
            ->orderBy('nombre')
            ->get();

        return view(
            'programaciones.create',
            compact('cursos')
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'id_curso' => [
                'required',
                'exists:cursos,id_curso',
            ],
            'fecha' => [
                'required',
                'date',
            ],
            'hora_inicio' => [
                'required',
                'date_format:H:i',
            ],
            'hora_fin' => [
                'required',
                'date_format:H:i',
                'after:hora_inicio',
            ],
        ]);

        $curso = Curso::findOrFail($datos['id_curso']);

        $this->validarFechaDentroDelCurso(
            $curso,
            $datos['fecha']
        );

        $duracion = (int) filter_var(
            $curso->duracion,
            FILTER_SANITIZE_NUMBER_INT
        );

        $cantidadProgramada = ProgramacionCurso::where(
            'id_curso',
            $curso->id_curso
        )->count();

        if ($cantidadProgramada >= $duracion) {
            throw ValidationException::withMessages([
                'id_curso' =>
                    "El curso \"{$curso->nombre}\" ya tiene programadas sus {$cantidadProgramada} de {$duracion} sesiones permitidas.",
            ]);
        }

        $programacionDuplicada = ProgramacionCurso::where(
            'id_curso',
            $curso->id_curso
        )
            ->whereDate('fecha', $datos['fecha'])
            ->where('hora_inicio', $datos['hora_inicio'])
            ->where('hora_fin', $datos['hora_fin'])
            ->exists();

        if ($programacionDuplicada) {
            throw ValidationException::withMessages([
                'fecha' =>
                    'Ya existe una sesión para este curso con la misma fecha y horario.',
            ]);
        }

        ProgramacionCurso::create($datos);

        return redirect()
            ->route('programaciones.index')
            ->with(
                'success',
                'Programación registrada correctamente.'
            );
    }

    public function edit(ProgramacionCurso $programacione)
    {
        $cursos = Curso::withCount('programaciones')
            ->orderBy('nombre')
            ->get();

        return view(
            'programaciones.edit',
            [
                'programacion' => $programacione,
                'cursos' => $cursos,
            ]
        );
    }

    public function update(
        Request $request,
        ProgramacionCurso $programacione
    ) {
        $datos = $request->validate([
            'id_curso' => [
                'required',
                'exists:cursos,id_curso',
            ],
            'fecha' => [
                'required',
                'date',
            ],
            'hora_inicio' => [
                'required',
                'date_format:H:i',
            ],
            'hora_fin' => [
                'required',
                'date_format:H:i',
                'after:hora_inicio',
            ],
        ]);

        $curso = Curso::findOrFail($datos['id_curso']);

        $this->validarFechaDentroDelCurso(
            $curso,
            $datos['fecha']
        );

        $duracion = (int) filter_var(
            $curso->duracion,
            FILTER_SANITIZE_NUMBER_INT
        );

        $cambioDeCurso =
            (int) $programacione->id_curso !==
            (int) $curso->id_curso;

        if ($cambioDeCurso) {
            $cantidadProgramada = ProgramacionCurso::where(
                'id_curso',
                $curso->id_curso
            )->count();

            if ($cantidadProgramada >= $duracion) {
                throw ValidationException::withMessages([
                    'id_curso' =>
                        "El curso \"{$curso->nombre}\" ya tiene programadas sus {$cantidadProgramada} de {$duracion} sesiones permitidas.",
                ]);
            }
        }

        $programacionDuplicada = ProgramacionCurso::where(
            'id_curso',
            $curso->id_curso
        )
            ->whereDate('fecha', $datos['fecha'])
            ->where('hora_inicio', $datos['hora_inicio'])
            ->where('hora_fin', $datos['hora_fin'])
            ->where(
                'id_programacion',
                '!=',
                $programacione->id_programacion
            )
            ->exists();

        if ($programacionDuplicada) {
            throw ValidationException::withMessages([
                'fecha' =>
                    'Ya existe otra sesión para este curso con la misma fecha y horario.',
            ]);
        }

        $programacione->update($datos);

        return redirect()
            ->route('programaciones.index')
            ->with(
                'success',
                'Programación actualizada correctamente.'
            );
    }

    public function destroy(ProgramacionCurso $programacione)
    {
        $programacione->delete();

        return redirect()
            ->route('programaciones.index')
            ->with(
                'success',
                'Programación eliminada correctamente.'
            );
    }

    private function validarFechaDentroDelCurso(
        Curso $curso,
        string $fecha
    ): void {
        if (
            $curso->fecha_inicio &&
            $fecha < $curso->fecha_inicio
        ) {
            throw ValidationException::withMessages([
                'fecha' =>
                    "La fecha de la sesión no puede ser anterior al inicio del curso, que es el {$curso->fecha_inicio}.",
            ]);
        }

        if (
            $curso->fecha_fin &&
            $fecha > $curso->fecha_fin
        ) {
            throw ValidationException::withMessages([
                'fecha' =>
                    "La fecha de la sesión no puede ser posterior al final del curso, que es el {$curso->fecha_fin}.",
            ]);
        }
    }
}