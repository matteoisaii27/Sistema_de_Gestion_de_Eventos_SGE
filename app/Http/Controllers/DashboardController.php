<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Inscripcion;
use App\Models\ProgramacionCurso;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCursos = Curso::count();

        $cursosActivos = Curso::where('estado', 'activo')->count();

        $totalDocentes = Docente::count();

        $totalInscripciones = Inscripcion::count();

        $inscripcionesConfirmadas = Inscripcion::where(
            'estado',
            'confirmada'
        )->count();

        $proximasProgramaciones = ProgramacionCurso::with('curso')
            ->whereDate('fecha', '>=', Carbon::today())
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->limit(5)
            ->get();

        $inscripcionesRecientes = Inscripcion::with([
            'asistente',
            'curso'
        ])
            ->orderByDesc('fecha_registro')
            ->limit(5)
            ->get();

        $inscripcionesPorCurso = Curso::withCount([
            'inscripciones as total_inscripciones'
        ])
            ->orderByDesc('total_inscripciones')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalCursos',
            'cursosActivos',
            'totalDocentes',
            'totalInscripciones',
            'inscripcionesConfirmadas',
            'proximasProgramaciones',
            'inscripcionesRecientes',
            'inscripcionesPorCurso'
        ));
    }
}