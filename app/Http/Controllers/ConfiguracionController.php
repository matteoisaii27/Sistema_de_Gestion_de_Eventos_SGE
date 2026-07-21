<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuracion = Configuracion::first();

        if (!$configuracion) {
            $configuracion = Configuracion::create([
                'nombre_sistema' =>
                    'Sistema de Gestión de Eventos',
                'inscripciones_habilitadas' => true,
            ]);
        }

        return view(
            'configuracion.index',
            compact('configuracion')
        );
    }

    public function update(
        Request $request,
        Configuracion $configuracion
    ) {
        $datos = $request->validate([
            'nombre_sistema' => 'required|string|max:150',
            'correo_contacto' => 'nullable|email|max:150',
            'telefono_contacto' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'mensaje_confirmacion' => 'nullable|string|max:1000',
            'mensaje_recordatorio' => 'nullable|string|max:1000',
            'inscripciones_habilitadas' => 'nullable|boolean',
        ]);

        $datos['inscripciones_habilitadas'] =
            $request->boolean('inscripciones_habilitadas');

        $configuracion->update($datos);

        return redirect()
            ->route('configuracion.index')
            ->with(
                'success',
                'Configuración actualizada correctamente.'
            );
    }
}