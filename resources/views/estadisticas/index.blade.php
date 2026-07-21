@extends('layouts.admin')

@section('title', 'Estadísticas | SGE')

@section('page-title', 'Estadísticas')

@section('content')

<div class="page-heading">
    <div>
        <h1>Estadísticas generales</h1>

        <p>
            Consulta el comportamiento de las inscripciones,
            la ocupación de los cursos y las próximas sesiones.
        </p>
    </div>
</div>

<div class="statistics-summary">

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">✓</span>
            <span class="stat-label">
                Total de inscripciones
            </span>
        </div>

        <strong class="stat-number">
            {{ $totalInscripciones }}
        </strong>

        <span class="stat-description">
            Inscripciones registradas
        </span>
    </article>

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">●</span>
            <span class="stat-label">
                Confirmadas
            </span>
        </div>

        <strong class="stat-number">
            {{ $confirmadas }}
        </strong>

        <span class="stat-description">
            Inscripciones confirmadas
        </span>
    </article>

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">◷</span>
            <span class="stat-label">
                Pendientes
            </span>
        </div>

        <strong class="stat-number">
            {{ $pendientes }}
        </strong>

        <span class="stat-description">
            Inscripciones pendientes
        </span>
    </article>

    <article class="stat-card">
        <div class="stat-card-header">
            <span class="stat-icon">×</span>
            <span class="stat-label">
                Canceladas
            </span>
        </div>

        <strong class="stat-number">
            {{ $canceladas }}
        </strong>

        <span class="stat-description">
            Inscripciones canceladas
        </span>
    </article>

</div>

<div class="statistics-grid">

    <section class="card dashboard-panel">

        <div class="panel-heading">
            <div>
                <h3>Estado de los cursos</h3>

                <p>
                    Resumen de cursos activos e inactivos.
                </p>
            </div>
        </div>

        <div class="course-status-summary">

            <div class="course-status-item">
                <span>Total de cursos</span>

                <strong>
                    {{ $totalCursos }}
                </strong>
            </div>

            <div class="course-status-item">
                <span>Cursos activos</span>

                <strong>
                    {{ $cursosActivos }}
                </strong>
            </div>

            <div class="course-status-item">
                <span>Cursos inactivos</span>

                <strong>
                    {{ $cursosInactivos }}
                </strong>
            </div>

        </div>

    </section>

    <section class="card dashboard-panel">

        <div class="panel-heading">
            <div>
                <h3>Resumen de inscripciones</h3>

                <p>
                    Distribución por estado.
                </p>
            </div>
        </div>

        <div class="enrollment-summary">

            <div class="enrollment-summary-row">
                <span>Confirmadas</span>

                <div>
                    <strong>{{ $confirmadas }}</strong>

                    <small>
                        {{ $totalInscripciones > 0
                            ? round(
                                ($confirmadas / $totalInscripciones)
                                * 100
                            )
                            : 0 }}%
                    </small>
                </div>
            </div>

            <div class="enrollment-summary-row">
                <span>Pendientes</span>

                <div>
                    <strong>{{ $pendientes }}</strong>

                    <small>
                        {{ $totalInscripciones > 0
                            ? round(
                                ($pendientes / $totalInscripciones)
                                * 100
                            )
                            : 0 }}%
                    </small>
                </div>
            </div>

            <div class="enrollment-summary-row">
                <span>Canceladas</span>

                <div>
                    <strong>{{ $canceladas }}</strong>

                    <small>
                        {{ $totalInscripciones > 0
                            ? round(
                                ($canceladas / $totalInscripciones)
                                * 100
                            )
                            : 0 }}%
                    </small>
                </div>
            </div>

        </div>

    </section>

</div>

<section class="card dashboard-panel statistics-section-card">

    <div class="panel-heading">
        <div>
            <h3>Ocupación por curso</h3>

            <p>
                Inscripciones confirmadas en relación con el cupo máximo.
            </p>
        </div>

        <a
            href="{{ route('cursos.index') }}"
            class="panel-link"
        >
            Ver cursos
        </a>
    </div>

    <div class="table-responsive">

        <table class="data-table">

            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Cupo máximo</th>
                    <th>Confirmadas</th>
                    <th>Disponibles</th>
                    <th>Ocupación</th>
                    <th>Total de registros</th>
                </tr>
            </thead>

            <tbody>

                @forelse($cursosEstadisticas as $curso)

                    <tr>
                        <td>
                            <strong>
                                {{ $curso->nombre }}
                            </strong>

                            <small class="table-secondary-text">
                                {{ ucfirst($curso->estado) }}
                            </small>
                        </td>

                        <td>
                            {{ $curso->cupo_maximo }}
                        </td>

                        <td>
                            {{ $curso->inscripciones_confirmadas_count }}
                        </td>

                        <td>
                            {{ $curso->lugares_disponibles }}
                        </td>

                        <td>
                            <div class="occupancy-cell">

                                <div class="occupancy-info">
                                    <span>
                                        {{ $curso->porcentaje_ocupacion }}%
                                    </span>
                                </div>

                                <div class="progress-track">
                                    <div
                                        class="progress-value"
                                        style="width:
                                            {{ $curso->porcentaje_ocupacion }}%"
                                    ></div>
                                </div>

                            </div>
                        </td>

                        <td>
                            {{ $curso->inscripciones_count }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="6"
                            class="empty-state"
                        >
                            <strong>
                                No existen cursos registrados
                            </strong>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

<section class="card dashboard-panel statistics-section-card">

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

    <div class="upcoming-session-grid">

        @forelse($proximasSesiones as $programacion)

            <article class="upcoming-session-card">

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

                <div>
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

            </article>

        @empty

            <div class="dashboard-empty statistics-empty">
                No existen sesiones próximas programadas.
            </div>

        @endforelse

    </div>

</section>

@endsection