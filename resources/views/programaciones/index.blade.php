@extends('layouts.admin')

@section('title', 'Programación de Cursos | SGE')
@section('page-title', 'Programación de Cursos')

@section('content')

@php
    $hoy = now()->startOfDay();

    $programacionesProximas = $programaciones->filter(
        fn ($programacion) =>
            \Carbon\Carbon::parse($programacion->fecha)->startOfDay() >= $hoy
    )->count();

    $programacionesPasadas = $programaciones->filter(
        fn ($programacion) =>
            \Carbon\Carbon::parse($programacion->fecha)->startOfDay() < $hoy
    )->count();

    $cursosProgramados = $programaciones
        ->pluck('id_curso')
        ->unique()
        ->count();
@endphp

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Calendario académico
        </span>

        <h1>Programación de Cursos</h1>

        <p>
            Administra las fechas y horarios asignados
            a cada curso o taller.
        </p>
    </div>

    <a
        href="{{ route('programaciones.create') }}"
        class="btn btn-primary"
    >
        <svg
            class="btn-icon"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path d="M12 5v14M5 12h14"/>
        </svg>

        Nueva programación
    </a>

</div>

<section class="schedule-summary">

    <article class="schedule-summary-card summary-turquoise">

        <div class="summary-icon">
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

        <div>
            <span>Total de sesiones</span>
            <strong>{{ $programaciones->count() }}</strong>
        </div>

    </article>

    <article class="schedule-summary-card summary-green">

        <div class="summary-icon">
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

        <div>
            <span>Sesiones próximas</span>
            <strong>{{ $programacionesProximas }}</strong>
        </div>

    </article>

    <article class="schedule-summary-card summary-orange">

        <div class="summary-icon">
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
            <span>Cursos programados</span>
            <strong>{{ $cursosProgramados }}</strong>
        </div>

    </article>

</section>

<section class="card">

    <div class="table-toolbar">

        <div>
            <span class="panel-kicker panel-kicker-turquoise">
                Agenda
            </span>

            <h3>Sesiones registradas</h3>

            <p>
                {{ $programaciones->count() }}
                {{ $programaciones->count() === 1
                    ? 'sesión programada'
                    : 'sesiones programadas' }}
            </p>
        </div>

        <div class="schedule-toolbar-info">

            <span class="schedule-indicator schedule-indicator-upcoming">
                <i></i>
                {{ $programacionesProximas }} próximas
            </span>

            <span class="schedule-indicator schedule-indicator-past">
                <i></i>
                {{ $programacionesPasadas }} finalizadas
            </span>

        </div>

    </div>

    <div class="table-responsive">

        <table class="data-table schedules-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Duración</th>
                    <th>Situación</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($programaciones as $programacion)

                    @php
                        $fechaProgramada = \Carbon\Carbon::parse(
                            $programacion->fecha
                        );

                        $horaInicio = \Carbon\Carbon::parse(
                            $programacion->hora_inicio
                        );

                        $horaFin = \Carbon\Carbon::parse(
                            $programacion->hora_fin
                        );

                        $minutosDuracion = $horaInicio->diffInMinutes($horaFin);

                        $horas = intdiv($minutosDuracion, 60);
                        $minutos = $minutosDuracion % 60;

                        $duracionTexto = $horas > 0
                            ? $horas . ' h' . ($minutos > 0 ? ' ' . $minutos . ' min' : '')
                            : $minutos . ' min';

                        $esHoy = $fechaProgramada->isToday();

                        $esProxima =
                            $fechaProgramada->copy()->startOfDay() >=
                            $hoy;
                    @endphp

                    <tr>

                        <td>
                            <span class="schedule-id">
                                #{{ $programacion->id_programacion }}
                            </span>
                        </td>

                        <td>
                            <div class="schedule-course">

                                <div class="schedule-course-icon">
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
                                        {{ $programacion->curso->nombre }}
                                    </strong>

                                    <span>
                                        Sesión del curso
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <div class="schedule-date">

                                <div class="schedule-calendar">

                                    <span>
                                        {{ strtoupper(
                                            $fechaProgramada
                                                ->locale('es')
                                                ->translatedFormat('M')
                                        ) }}
                                    </span>

                                    <strong>
                                        {{ $fechaProgramada->format('d') }}
                                    </strong>

                                </div>

                                <div>
                                    <strong>
                                        {{ ucfirst(
                                            $fechaProgramada
                                                ->locale('es')
                                                ->translatedFormat('l')
                                        ) }}
                                    </strong>

                                    <span>
                                        {{ $fechaProgramada->format('Y') }}
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <div class="schedule-time">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>

                                <div>
                                    <strong>
                                        {{ $horaInicio->format('H:i') }}
                                        –
                                        {{ $horaFin->format('H:i') }}
                                    </strong>

                                    <span>Horario de la sesión</span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <span class="schedule-duration">
                                {{ $duracionTexto }}
                            </span>
                        </td>

                        <td>
                            @if($esHoy)

                                <span class="schedule-status schedule-status-today">
                                    <i></i>
                                    Hoy
                                </span>

                            @elseif($esProxima)

                                <span class="schedule-status schedule-status-upcoming">
                                    <i></i>
                                    Próxima
                                </span>

                            @else

                                <span class="schedule-status schedule-status-past">
                                    <i></i>
                                    Finalizada
                                </span>

                            @endif
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'programaciones.edit',
                                        $programacion
                                    ) }}"
                                    class="action-button action-edit"
                                    title="Editar programación"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4z"/>
                                    </svg>

                                    <span>Editar</span>
                                </a>

                                <form
                                    action="{{ route(
                                        'programaciones.destroy',
                                        $programacion
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        '¿Seguro que deseas eliminar esta programación?'
                                    );"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-button action-delete"
                                        title="Eliminar programación"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path d="M3 6h18"/>
                                            <path d="M8 6V4h8v2"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M10 11v5M14 11v5"/>
                                        </svg>

                                        <span>Eliminar</span>
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="7"
                            class="empty-state"
                        >
                            <div class="table-empty-icon schedule-empty-icon">
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
                                No hay programaciones registradas
                            </strong>

                            <span>
                                Utiliza el botón “Nueva programación”
                                para registrar la primera sesión.
                            </span>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection