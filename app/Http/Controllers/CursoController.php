<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

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

    $curso->update($datos);

    return redirect()
        ->route('cursos.index')
        ->with('success', 'Curso actualizado correctamente.');
}

public function destroy(Curso $curso)
{
    $curso->delete();

    return redirect()
        ->route('cursos.index')
        ->with('success', 'Curso eliminado correctamente.');
}
}