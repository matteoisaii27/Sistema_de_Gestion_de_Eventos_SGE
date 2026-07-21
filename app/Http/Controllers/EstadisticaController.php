<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\ProgramacionCurso;
use Carbon\Carbon;

class EstadisticaController extends Controller
{
    public function index()
    {
        $totalInscripciones = Inscripcion::count();

        $confirmadas = Inscripcion::where(
            'estado',
            'confirmada'
        )->count();

        $pendientes = Inscripcion::where(
            'estado',
            'pendiente'
        )->count();

        $canceladas = Inscripcion::where(
            'estado',
            'cancelada'
        )->count();

        $totalCursos = Curso::count();

        $cursosActivos = Curso::where(
            'estado',
            'activo'
        )->count();

        $cursosInactivos = Curso::where(
            'estado',
            'inactivo'
        )->count();

        $cursosEstadisticas = Curso::withCount([
            'inscripciones',
            'inscripciones as inscripciones_confirmadas_count' =>
                function ($consulta) {
                    $consulta->where('estado', 'confirmada');
                }
        ])
            ->orderByDesc('inscripciones_count')
            ->get()
            ->map(function ($curso) {
                $cupo = (int) $curso->cupo_maximo;
                $confirmadas = (int)
                    $curso->inscripciones_confirmadas_count;

                $curso->porcentaje_ocupacion = $cupo > 0
                    ? min(
                        100,
                        round(($confirmadas / $cupo) * 100)
                    )
                    : 0;

                $curso->lugares_disponibles = max(
                    0,
                    $cupo - $confirmadas
                );

                return $curso;
            });

        $proximasSesiones = ProgramacionCurso::with('curso')
            ->whereDate('fecha', '>=', Carbon::today())
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->limit(8)
            ->get();

        return view('estadisticas.index', compact(
            'totalInscripciones',
            'confirmadas',
            'pendientes',
            'canceladas',
            'totalCursos',
            'cursosActivos',
            'cursosInactivos',
            'cursosEstadisticas',
            'proximasSesiones'
        ));
    }
}