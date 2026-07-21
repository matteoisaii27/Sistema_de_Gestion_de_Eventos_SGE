<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\ProgramacionCurso;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::orderByDesc('id_curso')->get();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'required|string',
            'duracion' => 'required|string|max:100',
            'cupo_maximo' => 'required|integer|min:1',
            'estado' => 'required|in:activo,inactivo',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Curso::create($datos);

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso registrado correctamente.');
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'required|string',
            'duracion' => 'required|string|max:100',
            'cupo_maximo' => 'required|integer|min:1',
            'estado' => 'required|in:activo,inactivo',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $duracionNueva = (int) filter_var(
            $datos['duracion'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $sesionesProgramadas = ProgramacionCurso::where(
            'id_curso',
            $curso->id_curso
        )->count();

        if ($duracionNueva < $sesionesProgramadas) {
            throw ValidationException::withMessages([
                'duracion' =>
                    "No es posible cambiar la duración a {$duracionNueva} sesiones porque este curso ya tiene programadas {$sesionesProgramadas} sesiones.",
            ]);
        }

        $curso->update($datos);

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Curso $curso)
    {
        $sesionesProgramadas = ProgramacionCurso::where(
            'id_curso',
            $curso->id_curso
        )->count();

        if ($sesionesProgramadas > 0) {
            return redirect()
                ->route('cursos.index')
                ->with(
                    'error',
                    "No es posible eliminar el curso \"{$curso->nombre}\" porque tiene {$sesionesProgramadas} sesiones programadas."
                );
        }

        $curso->delete();

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso eliminado correctamente.');
    }
}