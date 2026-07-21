@extends('layouts.publico')

@section('title', 'Calendario de Cursos | Jardín Filosófico')

@section('content')

<section class="calendar-hero">

    <div class="public-container">

        <span class="section-label">
            Próximas actividades
        </span>

        <h1>Calendario de cursos</h1>

        <p>
            Consulta las próximas fechas y horarios de los cursos
            disponibles en el Jardín Filosófico.
        </p>

    </div>

</section>

<section class="calendar-section">

    <div class="public-container">

        <div class="calendar-toolbar">

            <div>
                <h2>Próximas sesiones</h2>

                <p>
                    Se muestran únicamente cursos activos
                    con fechas programadas.
                </p>
            </div>

            <a
                href="{{ route('publico.cursos') }}"
                class="public-button public-button-secondary"
            >
                Ver todos los cursos
            </a>

        </div>

        <div class="calendar-list">

            @forelse($programaciones as $programacion)

                <article class="calendar-event">

                    <div class="calendar-event-date">

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

                        <small>
                            {{ \Carbon\Carbon::parse(
                                $programacion->fecha
                            )->format('Y') }}
                        </small>

                    </div>

                    <div class="calendar-event-content">

                        <span class="calendar-event-label">
                            Curso disponible
                        </span>

                        <h2>
                            {{ $programacion->curso->nombre }}
                        </h2>

                        <div class="calendar-event-details">

                            <span>
                                <strong>Fecha:</strong>

                                {{ \Carbon\Carbon::parse(
                                    $programacion->fecha
                                )->translatedFormat(
                                    'l, d \d\e F \d\e Y'
                                ) }}
                            </span>

                            <span>
                                <strong>Horario:</strong>

                                {{ \Carbon\Carbon::parse(
                                    $programacion->hora_inicio
                                )->format('H:i') }}

                                a

                                {{ \Carbon\Carbon::parse(
                                    $programacion->hora_fin
                                )->format('H:i') }}
                            </span>

                            <span>
                                <strong>Duración del curso:</strong>

                                {{ $programacion->curso->duracion }}
                            </span>

                        </div>

                    </div>

                    <div class="calendar-event-action">

                        <a
                            href="{{ route(
                                'publico.detalle',
                                $programacion->curso
                            ) }}"
                            class="public-button"
                        >
                            Ver curso
                        </a>

                    </div>

                </article>

            @empty

                <div class="public-empty calendar-empty">

                    <strong>
                        No hay sesiones programadas
                    </strong>

                    <p>
                        Próximamente se publicarán nuevas fechas
                        y horarios.
                    </p>

                    <a
                        href="{{ route('publico.cursos') }}"
                        class="public-button"
                    >
                        Explorar cursos
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection