<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            'imagen_principal' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $datos['inscripciones_habilitadas'] =
            $request->boolean('inscripciones_habilitadas');

        if ($request->hasFile('imagen_principal')) {

            $imagenAnterior = $configuracion->imagen_principal;

            $datos['imagen_principal'] = $request
                ->file('imagen_principal')
                ->store('jardin', 'public');

            $configuracion->update($datos);

            if ($imagenAnterior) {
                Storage::disk('public')->delete($imagenAnterior);
            }

        } else {

            unset($datos['imagen_principal']);

            $configuracion->update($datos);

        }

        return redirect()
            ->route('configuracion.index')
            ->with(
                'success',
                'Configuración actualizada correctamente.'
            );
    }
}