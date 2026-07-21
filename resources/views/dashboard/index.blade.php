@extends('layouts.admin')

@section('title', 'Dashboard | SGE')

@section('page-title', 'Dashboard')

@section('content')

<div class="page-heading">
    <div>
        <h1>Resumen general</h1>

        <p>
            Consulta la actividad principal del Sistema de Gestión
            de Eventos del Jardín Filosófico.
        </p>
    </div>
</div>

<div class="dashboard-stats">

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">▣</span>
            <span class="stat-label">Cursos registrados</span>
        </div>

        <strong class="stat-number">
            {{ $totalCursos }}
        </strong>

        <span class="stat-description">
            {{ $cursosActivos }} cursos activos
        </span>
    </article>

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">♙</span>
            <span class="stat-label">Docentes</span>
        </div>

        <strong class="stat-number">
            {{ $totalDocentes }}
        </strong>

        <span class="stat-description">
            Docentes registrados
        </span>
    </article>

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">✓</span>
            <span class="stat-label">Inscripciones</span>
        </div>

        <strong class="stat-number">
            {{ $totalInscripciones }}
        </strong>

        <span class="stat-description">
            {{ $inscripcionesConfirmadas }} confirmadas
        </span>
    </article>

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">◷</span>
            <span class="stat-label">Próximas sesiones</span>
        </div>

        <strong class="stat-number">
            {{ $proximasProgramaciones->count() }}
        </strong>

        <span class="stat-description">
            Sesiones próximas mostradas
        </span>
    </article>

</div>

<div class="dashboard-grid">

    <section class="card dashboard-panel">

        <div class="panel-heading">
            <div>
                <h3>Próximas sesiones</h3>

                <p>
                    Fechas y horarios programados próximamente.
                </p>
            </div>

            <a
                href="{{ route('programaciones.index') }}"
                class="panel-link"
            >
                Ver programación
            </a>
        </div>

        <div class="dashboard-list">

            @forelse($proximasProgramaciones as $programacion)

                <div class="dashboard-list-item">

                    <div class="date-box">
                        <strong>
                            {{ \Carbon\Carbon::parse(
                                $programacion->fecha
                            )->format('d') }}
                        </strong>

                        <span>
                            {{ strtoupper(
                                \Carbon\Carbon::parse(
                                    $programacion->fecha
                                )->translatedFormat('M')
                            ) }}
                        </span>
                    </div>

                    <div class="list-item-content">
                        <strong>
                            {{ $programacion->curso->nombre }}
                        </strong>

                        <span>
                            {{ \Carbon\Carbon::parse(
                                $programacion->hora_inicio
                            )->format('H:i') }}

                            a

                            {{ \Carbon\Carbon::parse(
                                $programacion->hora_fin
                            )->format('H:i') }}
                        </span>
                    </div>

                </div>

            @empty

                <div class="dashboard-empty">
                    No existen sesiones próximas programadas.
                </div>

            @endforelse

        </div>

    </section>

    <section class="card dashboard-panel">

        <div class="panel-heading">
            <div>
                <h3>Inscripciones por curso</h3>

                <p>
                    Cursos con mayor número de asistentes.
                </p>
            </div>

            <a
                href="{{ route('inscripciones.index') }}"
                class="panel-link"
            >
                Ver inscripciones
            </a>
        </div>

        <div class="course-ranking">

            @forelse($inscripcionesPorCurso as $curso)

                <div class="ranking-item">

                    <div class="ranking-info">
                        <strong>
                            {{ $curso->nombre }}
                        </strong>

                        <span>
                            {{ $curso->total_inscripciones }}
                            {{ $curso->total_inscripciones === 1
                                ? 'inscripción'
                                : 'inscripciones' }}
                        </span>
                    </div>

                    <div class="ranking-number">
                        {{ $curso->total_inscripciones }}
                    </div>

                </div>

            @empty

                <div class="dashboard-empty">
                    Todavía no existen cursos registrados.
                </div>

            @endforelse

        </div>

    </section>

</div>

<section class="card dashboard-panel dashboard-wide">

    <div class="panel-heading">
        <div>
            <h3>Inscripciones recientes</h3>

            <p>
                Últimas personas registradas en los cursos.
            </p>
        </div>

        <a
            href="{{ route('inscripciones.index') }}"
            class="panel-link"
        >
            Consultar todas
        </a>
    </div>

    <div class="table-responsive">

        <table class="data-table">

            <thead>
                <tr>
                    <th>Asistente</th>
                    <th>Curso</th>
                    <th>Fecha de registro</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

                @forelse($inscripcionesRecientes as $inscripcion)

                    <tr>
                        <td>
                            <strong>
                                {{ $inscripcion->asistente->nombre }}
                            </strong>

                            <small class="table-secondary-text">
                                {{ $inscripcion->asistente->correo }}
                            </small>
                        </td>

                        <td>
                            {{ $inscripcion->curso->nombre }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse(
                                $inscripcion->fecha_registro
                            )->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            <span class="status-badge
                                {{ $inscripcion->estado === 'confirmada'
                                    ? 'status-active'
                                    : '' }}
                            ">
                                {{ ucfirst($inscripcion->estado) }}
                            </span>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="empty-state">
                            <strong>
                                No existen inscripciones recientes
                            </strong>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection