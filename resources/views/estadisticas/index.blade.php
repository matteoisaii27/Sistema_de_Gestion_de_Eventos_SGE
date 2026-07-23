@extends('layouts.admin')

@section('title', 'Estadísticas | SGE')
@section('page-title', 'Estadísticas')

@section('content')

@php
    $porcentajeConfirmadas = $totalInscripciones > 0
        ? round(($confirmadas / $totalInscripciones) * 100)
        : 0;

    $porcentajePendientes = $totalInscripciones > 0
        ? round(($pendientes / $totalInscripciones) * 100)
        : 0;

    $porcentajeCanceladas = $totalInscripciones > 0
        ? round(($canceladas / $totalInscripciones) * 100)
        : 0;

    $porcentajeCursosActivos = $totalCursos > 0
        ? round(($cursosActivos / $totalCursos) * 100)
        : 0;

    $cursoMasSolicitado = $cursosEstadisticas->first();

    $promedioOcupacion = $cursosEstadisticas->count() > 0
        ? round($cursosEstadisticas->avg('porcentaje_ocupacion'))
        : 0;
@endphp

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Análisis general
        </span>

        <h1>Estadísticas del sistema</h1>

        <p>
            Consulta el comportamiento de las inscripciones,
            la ocupación de los cursos y las próximas sesiones.
        </p>
    </div>

    <div class="statistics-heading-badge">

        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path d="M4 20V10"/>
            <path d="M10 20V4"/>
            <path d="M16 20v-7"/>
            <path d="M22 20H2"/>
        </svg>

        <div>
            <span>Resumen actualizado</span>
            <strong>
                {{ now()->format('d/m/Y') }}
            </strong>
        </div>

    </div>

</div>

<section class="statistics-main-summary">

    <article class="statistics-main-card statistics-card-purple">

        <div class="statistics-card-top">

            <div class="statistics-main-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="9" cy="8" r="4"/>
                    <path d="M2.5 21a6.5 6.5 0 0 1 13 0"/>
                    <path d="M17 8h5M19.5 5.5v5"/>
                </svg>
            </div>

            <span class="statistics-card-tag">
                Registros
            </span>

        </div>

        <strong class="statistics-main-number">
            {{ $totalInscripciones }}
        </strong>

        <span class="statistics-main-label">
            Total de inscripciones
        </span>

        <p>
            Personas registradas en todos los cursos.
        </p>

    </article>

    <article class="statistics-main-card statistics-card-green">

        <div class="statistics-card-top">

            <div class="statistics-main-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M8 12l3 3 5-6"/>
                </svg>
            </div>

            <span class="statistics-card-tag">
                {{ $porcentajeConfirmadas }}%
            </span>

        </div>

        <strong class="statistics-main-number">
            {{ $confirmadas }}
        </strong>

        <span class="statistics-main-label">
            Confirmadas
        </span>

        <p>
            Inscripciones vigentes y confirmadas.
        </p>

    </article>

    <article class="statistics-main-card statistics-card-orange">

        <div class="statistics-card-top">

            <div class="statistics-main-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 7v5l3 2"/>
                </svg>
            </div>

            <span class="statistics-card-tag">
                {{ $porcentajePendientes }}%
            </span>

        </div>

        <strong class="statistics-main-number">
            {{ $pendientes }}
        </strong>

        <span class="statistics-main-label">
            Pendientes
        </span>

        <p>
            Registros que requieren seguimiento.
        </p>

    </article>

    <article class="statistics-main-card statistics-card-pink">

        <div class="statistics-card-top">

            <div class="statistics-main-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M9 9l6 6M15 9l-6 6"/>
                </svg>
            </div>

            <span class="statistics-card-tag">
                {{ $porcentajeCanceladas }}%
            </span>

        </div>

        <strong class="statistics-main-number">
            {{ $canceladas }}
        </strong>

        <span class="statistics-main-label">
            Canceladas
        </span>

        <p>
            Inscripciones que ya no se encuentran vigentes.
        </p>

    </article>

</section>

<section class="statistics-insight-grid">

    <article class="card statistics-insight-card">

        <div class="statistics-insight-header">

            <div class="statistics-insight-icon insight-turquoise">
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

            <div>
                <span>Oferta académica</span>
                <h3>Estado de los cursos</h3>
            </div>

        </div>

        <div class="statistics-course-total">

            <div>
                <strong>{{ $totalCursos }}</strong>
                <span>Cursos registrados</span>
            </div>

            <div class="statistics-course-percentage">
                {{ $porcentajeCursosActivos }}%
                <span>activos</span>
            </div>

        </div>

        <div class="statistics-course-statuses">

            <div class="statistics-course-status-row">

                <div>
                    <i class="course-dot-active"></i>
                    <span>Cursos activos</span>
                </div>

                <strong>{{ $cursosActivos }}</strong>

            </div>

            <div class="statistics-course-status-row">

                <div>
                    <i class="course-dot-inactive"></i>
                    <span>Cursos inactivos</span>
                </div>

                <strong>{{ $cursosInactivos }}</strong>

            </div>

        </div>

        <div class="statistics-course-progress">

            <div
                style="width: {{ $porcentajeCursosActivos }}%"
                class="statistics-course-progress-value"
            ></div>

        </div>

    </article>

    <article class="card statistics-insight-card">

        <div class="statistics-insight-header">

            <div class="statistics-insight-icon insight-purple">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 3a9 9 0 0 1 9 9h-9z"/>
                </svg>
            </div>

            <div>
                <span>Participación</span>
                <h3>Distribución de inscripciones</h3>
            </div>

        </div>

        <div class="statistics-distribution">

<div
    class="statistics-distribution-circle"
    style="--confirmed-percentage: {{ $porcentajeConfirmadas }};"
>
                <strong>
                    {{ $porcentajeConfirmadas }}%
                </strong>

                <span>
                    confirmadas
                </span>

            </div>

            <div class="statistics-distribution-list">

                <div>
                    <span>
                        <i class="distribution-confirmed"></i>
                        Confirmadas
                    </span>

                    <strong>
                        {{ $confirmadas }}
                    </strong>
                </div>

                <div>
                    <span>
                        <i class="distribution-pending"></i>
                        Pendientes
                    </span>

                    <strong>
                        {{ $pendientes }}
                    </strong>
                </div>

                <div>
                    <span>
                        <i class="distribution-cancelled"></i>
                        Canceladas
                    </span>

                    <strong>
                        {{ $canceladas }}
                    </strong>
                </div>

            </div>

        </div>

    </article>

    <article class="card statistics-insight-card statistics-featured-course">

        <div class="statistics-insight-header">

            <div class="statistics-insight-icon insight-orange">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M12 2l2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 16.3 6.4 19.2 7.5 13 3 8.6l6.2-.9z"/>
                </svg>
            </div>

            <div>
                <span>Mayor demanda</span>
                <h3>Curso más solicitado</h3>
            </div>

        </div>

        @if($cursoMasSolicitado)

            <div class="statistics-featured-content">

                <span class="statistics-featured-status">
                    {{ ucfirst($cursoMasSolicitado->estado) }}
                </span>

                <strong>
                    {{ $cursoMasSolicitado->nombre }}
                </strong>

                <p>
                    Es el curso con mayor número de registros
                    dentro del sistema.
                </p>

                <div class="statistics-featured-values">

                    <div>
                        <span>Total de registros</span>
                        <strong>
                            {{ $cursoMasSolicitado->inscripciones_count }}
                        </strong>
                    </div>

                    <div>
                        <span>Ocupación</span>
                        <strong>
                            {{ $cursoMasSolicitado->porcentaje_ocupacion }}%
                        </strong>
                    </div>

                </div>

            </div>

        @else

            <div class="dashboard-empty statistics-small-empty">
                No hay cursos registrados.
            </div>

        @endif

    </article>

</section>

<section class="card statistics-section-card">

    <div class="panel-heading statistics-panel-heading">

        <div>

            <span class="panel-kicker panel-kicker-turquoise">
                Capacidad
            </span>

            <h3>Ocupación por curso</h3>

            <p>
                Inscripciones confirmadas en relación con el cupo máximo.
            </p>

        </div>

        <div class="statistics-panel-actions">

            <div class="statistics-average-badge">

                <span>Ocupación promedio</span>

                <strong>
                    {{ $promedioOcupacion }}%
                </strong>

            </div>

            <a
                href="{{ route('cursos.index') }}"
                class="panel-link"
            >
                Ver cursos

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </a>

        </div>

    </div>

    <div class="table-responsive">

        <table class="data-table statistics-courses-table">

            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Estado</th>
                    <th>Cupo</th>
                    <th>Confirmadas</th>
                    <th>Disponibles</th>
                    <th>Ocupación</th>
                    <th>Registros</th>
                </tr>
            </thead>

            <tbody>

                @forelse($cursosEstadisticas as $curso)

                    <tr>

                        <td>
                            <div class="statistics-course-name">

                                <div class="statistics-course-icon">
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

                                <div>
                                    <strong>
                                        {{ $curso->nombre }}
                                    </strong>

                                    <span>
                                        Curso #{{ $curso->id_curso }}
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            @if($curso->estado === 'activo')

                                <span class="statistics-course-badge course-badge-active">
                                    <i></i>
                                    Activo
                                </span>

                            @else

                                <span class="statistics-course-badge course-badge-inactive">
                                    <i></i>
                                    Inactivo
                                </span>

                            @endif
                        </td>

                        <td>
                            <span class="statistics-number-cell">
                                {{ $curso->cupo_maximo }}
                            </span>
                        </td>

                        <td>
                            <span class="statistics-number-cell number-confirmed">
                                {{ $curso->inscripciones_confirmadas_count }}
                            </span>
                        </td>

                        <td>
                            <span class="statistics-number-cell number-available">
                                {{ $curso->lugares_disponibles }}
                            </span>
                        </td>

                        <td>
                            <div class="statistics-occupancy">

                                <div class="statistics-occupancy-header">

                                    <span>
                                        {{ $curso->porcentaje_ocupacion }}%
                                    </span>

                                    @if($curso->porcentaje_ocupacion >= 100)

                                        <small class="occupancy-full">
                                            Completo
                                        </small>

                                    @elseif($curso->porcentaje_ocupacion >= 75)

                                        <small class="occupancy-high">
                                            Alta
                                        </small>

                                    @else

                                        <small class="occupancy-available">
                                            Disponible
                                        </small>

                                    @endif

                                </div>

                                <div class="statistics-progress-track">

                                    <div
                                        class="statistics-progress-value
                                        @if($curso->porcentaje_ocupacion >= 100)
                                            progress-full
                                        @elseif($curso->porcentaje_ocupacion >= 75)
                                            progress-high
                                        @else
                                            progress-available
                                        @endif"
                                        style="width: {{ $curso->porcentaje_ocupacion }}%"
                                    ></div>

                                </div>

                            </div>
                        </td>

                        <td>
                            <span class="statistics-total-records">
                                {{ $curso->inscripciones_count }}
                            </span>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="7"
                            class="empty-state"
                        >
                            <div class="table-empty-icon">
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

                            <strong>
                                No existen cursos registrados
                            </strong>

                            <span>
                                Los datos de ocupación aparecerán
                                cuando existan cursos.
                            </span>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

<section class="card statistics-section-card">

    <div class="panel-heading statistics-panel-heading">

        <div>

            <span class="panel-kicker panel-kicker-orange">
                Calendario
            </span>

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

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M5 12h14M13 6l6 6-6 6"/>
            </svg>
        </a>

    </div>

    <div class="statistics-sessions-grid">

        @forelse($proximasSesiones as $programacion)

            @php
                $fechaSesion = \Carbon\Carbon::parse(
                    $programacion->fecha
                );

                $esHoy = $fechaSesion->isToday();
            @endphp

            <article class="statistics-session-card">

                <div class="statistics-session-date">

                    <span>
                        {{ strtoupper(
                            $fechaSesion->locale('es')->translatedFormat('M')
                        ) }}
                    </span>

                    <strong>
                        {{ $fechaSesion->format('d') }}
                    </strong>

                    <small>
                        {{ $fechaSesion->format('Y') }}
                    </small>

                </div>

                <div class="statistics-session-information">

                    <div class="statistics-session-heading">

                        <span class="statistics-session-status">
                            {{ $esHoy ? 'Hoy' : 'Próxima' }}
                        </span>

                        <span>
                            Sesión programada
                        </span>

                    </div>

                    <strong>
                        {{ $programacion->curso->nombre }}
                    </strong>

                    <div class="statistics-session-time">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 7v5l3 2"/>
                        </svg>

                        <span>
                            {{ \Carbon\Carbon::parse(
                                $programacion->hora_inicio
                            )->format('H:i') }}

                            –

                            {{ \Carbon\Carbon::parse(
                                $programacion->hora_fin
                            )->format('H:i') }} h
                        </span>

                    </div>

                </div>

            </article>

        @empty

            <div class="dashboard-empty statistics-empty">

                <div class="table-empty-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                    </svg>
                </div>

                <strong>
                    No existen sesiones próximas
                </strong>

                <span>
                    Las nuevas programaciones aparecerán aquí.
                </span>

            </div>

        @endforelse

    </div>

</section>

@endsection