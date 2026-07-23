@extends('layouts.admin')

@section('title', 'Dashboard | SGE')
@section('page-title', 'Dashboard')

@section('content')

<section class="dashboard-welcome">

    <div>
        <span class="dashboard-eyebrow">
            Resumen general
        </span>

        <h1>
            Bienvenido, {{ auth()->user()->name }}
        </h1>

        <p>
            Consulta el estado actual de los cursos, docentes,
            programaciones e inscripciones del Jardín Filosófico.
        </p>
    </div>

    <div class="dashboard-date">
        <span>Fecha actual</span>
        <strong>
            {{ now()->locale('es')->translatedFormat('d \d\e F \d\e Y') }}
        </strong>
    </div>

</section>

<section class="dashboard-stats">

    <article class="stat-card stat-card-green">

        <div class="stat-card-top">

            <div class="stat-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                    <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
                </svg>
            </div>

            <span class="stat-badge">
                {{ $cursosActivos }} activos
            </span>

        </div>

        <strong class="stat-number">
            {{ $totalCursos }}
        </strong>

        <span class="stat-label">
            Cursos registrados
        </span>

        <a
            href="{{ route('cursos.index') }}"
            class="stat-link"
        >
            Gestionar cursos
            <span>→</span>
        </a>

    </article>

    <article class="stat-card stat-card-turquoise">

        <div class="stat-card-top">

            <div class="stat-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4.5 21a7.5 7.5 0 0 1 15 0"/>
                </svg>
            </div>

            <span class="stat-badge">
                Personal
            </span>

        </div>

        <strong class="stat-number">
            {{ $totalDocentes }}
        </strong>

        <span class="stat-label">
            Docentes registrados
        </span>

        <a
            href="{{ route('docentes.index') }}"
            class="stat-link"
        >
            Ver docentes
            <span>→</span>
        </a>

    </article>

    <article class="stat-card stat-card-orange">

        <div class="stat-card-top">

            <div class="stat-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M9 11l3 3L22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
            </div>

            <span class="stat-badge">
                {{ $inscripcionesConfirmadas }} confirmadas
            </span>

        </div>

        <strong class="stat-number">
            {{ $totalInscripciones }}
        </strong>

        <span class="stat-label">
            Inscripciones totales
        </span>

        <a
            href="{{ route('inscripciones.index') }}"
            class="stat-link"
        >
            Consultar inscripciones
            <span>→</span>
        </a>

    </article>

    <article class="stat-card stat-card-purple">

        <div class="stat-card-top">

            <div class="stat-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <rect x="3" y="5" width="18" height="16" rx="3"/>
                    <path d="M16 3v4M8 3v4M3 10h18"/>
                </svg>
            </div>

            <span class="stat-badge">
                Próximamente
            </span>

        </div>

        <strong class="stat-number">
            {{ $proximasProgramaciones->count() }}
        </strong>

        <span class="stat-label">
            Próximas sesiones
        </span>

        <a
            href="{{ route('programaciones.index') }}"
            class="stat-link"
        >
            Ver programación
            <span>→</span>
        </a>

    </article>

</section>

<section class="dashboard-grid">

    <article class="card dashboard-panel">

        <div class="panel-heading">

            <div>
                <span class="panel-kicker panel-kicker-purple">
                    Agenda
                </span>

                <h3>Próximas programaciones</h3>

                <p>
                    Sesiones programadas a partir de hoy.
                </p>
            </div>

            <a
                href="{{ route('programaciones.index') }}"
                class="panel-link"
            >
                Ver todas
            </a>

        </div>

        @forelse($proximasProgramaciones as $programacion)

            <div class="schedule-item">

                <div class="date-box">
                    <strong>
                        {{ \Carbon\Carbon::parse($programacion->fecha)->format('d') }}
                    </strong>

                    <span>
                        {{ \Carbon\Carbon::parse($programacion->fecha)
                            ->locale('es')
                            ->translatedFormat('M') }}
                    </span>
                </div>

                <div class="schedule-content">

                    <strong>
                        {{ $programacion->curso->nombre ?? 'Curso no disponible' }}
                    </strong>

                    <span>
                        {{ \Carbon\Carbon::parse($programacion->hora_inicio)->format('H:i') }}
                        –
                        {{ \Carbon\Carbon::parse($programacion->hora_fin)->format('H:i') }}
                    </span>

                </div>

                <div class="schedule-status">
                    Programado
                </div>

            </div>

        @empty

            <div class="dashboard-empty">
                <div class="empty-icon">📅</div>
                <strong>No hay próximas sesiones</strong>
                <span>
                    Las nuevas programaciones aparecerán aquí.
                </span>
            </div>

        @endforelse

    </article>

    <article class="card dashboard-panel">

        <div class="panel-heading">

            <div>
                <span class="panel-kicker panel-kicker-orange">
                    Participación
                </span>

                <h3>Cursos con más inscritos</h3>

                <p>
                    Clasificación según el número de registros.
                </p>
            </div>

            <a
                href="{{ route('estadisticas.index') }}"
                class="panel-link"
            >
                Estadísticas
            </a>

        </div>

        <div class="course-ranking">

            @forelse($inscripcionesPorCurso as $index => $curso)

                @php
                    $maximo = max(
                        1,
                        $inscripcionesPorCurso->max('total_inscripciones')
                    );

                    $porcentaje = min(
                        100,
                        ($curso->total_inscripciones / $maximo) * 100
                    );
                @endphp

                <div class="ranking-item">

                    <div class="ranking-position">
                        {{ $index + 1 }}
                    </div>

                    <div class="ranking-main">

                        <div class="ranking-heading">

                            <div class="ranking-info">
                                <strong>{{ $curso->nombre }}</strong>

                                <span>
                                    {{ $curso->total_inscripciones }}
                                    {{ $curso->total_inscripciones === 1
                                        ? 'inscripción'
                                        : 'inscripciones' }}
                                </span>
                            </div>

                            <strong class="ranking-number">
                                {{ $curso->total_inscripciones }}
                            </strong>

                        </div>

                        <div class="ranking-progress">
                            <span style="width: {{ $porcentaje }}%"></span>
                        </div>

                    </div>

                </div>

            @empty

                <div class="dashboard-empty">
                    <div class="empty-icon">📊</div>
                    <strong>No hay datos disponibles</strong>
                    <span>
                        Los cursos aparecerán cuando reciban inscripciones.
                    </span>
                </div>

            @endforelse

        </div>

    </article>

</section>

<section class="card dashboard-wide">

    <div class="table-toolbar">

        <div>
            <span class="panel-kicker panel-kicker-turquoise">
                Actividad reciente
            </span>

            <h3>Últimas inscripciones</h3>

            <p>
                Registros más recientes realizados en el sistema.
            </p>
        </div>

        <a
            href="{{ route('inscripciones.index') }}"
            class="btn btn-secondary"
        >
            Ver todas
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
                            <div class="person-cell">

                                <div class="person-avatar">
                                    {{ strtoupper(
                                        substr(
                                            $inscripcion->asistente->nombre ?? 'A',
                                            0,
                                            1
                                        )
                                    ) }}
                                </div>

                                <div>
                                    <strong>
                                        {{ $inscripcion->asistente->nombre ?? 'Asistente no disponible' }}
                                    </strong>

                                    <span>
                                        {{ $inscripcion->asistente->correo ?? 'Sin correo' }}
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <strong>
                                {{ $inscripcion->curso->nombre ?? 'Curso no disponible' }}
                            </strong>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($inscripcion->fecha_registro)
                                ->locale('es')
                                ->translatedFormat('d M Y, H:i') }}
                        </td>

                        <td>
                            <span class="status
                                {{ $inscripcion->estado === 'confirmada'
                                    ? 'status-active'
                                    : 'status-pending' }}"
                            >
                                {{ ucfirst($inscripcion->estado) }}
                            </span>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="4"
                            class="empty-state"
                        >
                            <strong>No hay inscripciones recientes</strong>

                            <span>
                                Los nuevos registros aparecerán en esta tabla.
                            </span>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection