<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\ProgramacionCurso;
use Illuminate\Http\Request;

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
        $cursos = Curso::orderBy('nombre')->get();

        return view(
            'programaciones.create',
            compact('cursos')
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'id_curso' => 'required|exists:cursos,id_curso',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

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
        $cursos = Curso::orderBy('nombre')->get();

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
            'id_curso' => 'required|exists:cursos,id_curso',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

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
}