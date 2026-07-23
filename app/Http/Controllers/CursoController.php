<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\ProgramacionCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'duracion' => 'required|string|max:100',
            'cupo_maximo' => 'required|integer|min:1',
            'estado' => 'required|in:activo,inactivo',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request
                ->file('imagen')
                ->store('cursos', 'public');
        }

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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

        if ($request->hasFile('imagen')) {
            $imagenAnterior = $curso->imagen;

            $datos['imagen'] = $request
                ->file('imagen')
                ->store('cursos', 'public');

            $curso->update($datos);

            if ($imagenAnterior) {
                Storage::disk('public')->delete($imagenAnterior);
            }
        } else {
            unset($datos['imagen']);

            $curso->update($datos);
        }

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

        $imagenCurso = $curso->imagen;

        $curso->delete();

        if ($imagenCurso) {
            Storage::disk('public')->delete($imagenCurso);
        }

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso eliminado correctamente.');
    }
}