<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::orderByDesc('id_docente')->get();

        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'correo' => 'required|email|max:150|unique:docentes,correo',
            'bio' => 'nullable|string',
        ]);

        Docente::create($datos);

        return redirect()
            ->route('docentes.index')
            ->with('success', 'Docente registrado correctamente.');
    }

    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'correo' => [
                'required',
                'email',
                'max:150',
                Rule::unique('docentes', 'correo')
                    ->ignore($docente->id_docente, 'id_docente'),
            ],
            'bio' => 'nullable|string',
        ]);

        $docente->update($datos);

        return redirect()
            ->route('docentes.index')
            ->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();

        return redirect()
            ->route('docentes.index')
            ->with('success', 'Docente eliminado correctamente.');
    }
}