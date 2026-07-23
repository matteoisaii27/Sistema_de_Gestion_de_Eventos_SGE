@extends('layouts.publico')

@section('title', $curso->nombre . ' | Jardín Filosófico')

@section('content')

{{-- =====================================================
     ENCABEZADO DEL CURSO
===================================================== --}}

<section class="detail-editorial-hero">

    <div class="public-container">

        <a
            href="{{ route('publico.cursos') }}"
            class="detail-editorial-back"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M19 12H5"/>
                <path d="m11 18-6-6 6-6"/>
            </svg>

            Volver a cursos
        </a>

        <div class="detail-editorial-grid">

            {{-- Información principal --}}
            <div class="detail-editorial-content">

                <span class="detail-editorial-eyebrow">
                    Jardín Filosófico
                </span>

                <div class="detail-editorial-status">

                    <span></span>

                    Curso disponible

                </div>

                <h1>
                    {{ $curso->nombre }}
                </h1>

                <p class="detail-editorial-description">
                    {{ $curso->descripcion }}
                </p>

                <div class="detail-editorial-data">

                    <div class="detail-editorial-data-item">

                        <span class="detail-editorial-data-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>

                        </span>

                        <div>
                            <span>Duración</span>
                            <strong>{{ $curso->duracion }}</strong>
                        </div>

                    </div>

                    <div class="detail-editorial-data-item">

                        <span class="detail-editorial-data-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="16"
                                    rx="2"
                                />

                                <path d="M16 3v4M8 3v4M3 10h18"/>
                            </svg>

                        </span>

                        <div>
                            <span>Fecha de inicio</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($curso->fecha_inicio)
                                    ->locale('es')
                                    ->translatedFormat('d \d\e F \d\e Y') }}
                            </strong>
                        </div>

                    </div>

                    <div class="detail-editorial-data-item">

                        <span class="detail-editorial-data-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <circle cx="9" cy="8" r="4"/>
                                <path d="M2.5 21a6.5 6.5 0 0 1 13 0"/>
                                <path d="M17 8h4M19 6v4"/>
                            </svg>

                        </span>

                        <div>
                            <span>Cupo máximo</span>

                            <strong>
                                {{ $curso->cupo_maximo }} lugares
                            </strong>
                        </div>

                    </div>

                </div>

                <div class="detail-editorial-actions">

                    <a
                        href="{{ route('publico.inscripcion', $curso) }}"
                        class="public-button"
                    >
                        Inscribirme

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>
                    </a>

                    <a
                        href="#programacion"
                        class="public-button public-button-secondary"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="2"
                            />

                            <path d="M16 3v4M8 3v4M3 10h18"/>
                        </svg>

                        Consultar fechas
                    </a>

                </div>

            </div>

            {{-- Imagen del curso --}}
            <div class="detail-editorial-visual">

                <div class="detail-editorial-image">

                    <div class="detail-editorial-placeholder">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="16"
                                rx="2"
                            />

                            <circle cx="8.5" cy="9" r="1.5"/>
                            <path d="m4 17 5-5 4 4 2-2 5 5"/>
                        </svg>

                        <span>Imagen del curso</span>

                    </div>

                </div>

                <div class="detail-editorial-image-caption">

                    <span>Programa educativo</span>

                    <strong>
                        Jardín Filosófico
                    </strong>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     INFORMACIÓN DEL CURSO
===================================================== --}}

<section
    id="informacion"
    class="detail-editorial-section"
>

    <div class="public-container detail-editorial-layout">

        <main class="detail-editorial-main">

            {{-- Descripción --}}
            <article class="detail-editorial-block detail-editorial-about">

                <header class="detail-editorial-heading">

                    <span class="section-label">
                        Descripción
                    </span>

                    <h2>
                        Acerca del curso
                    </h2>

                </header>

                <div class="detail-editorial-text">

                    <p>
                        {{ $curso->descripcion }}
                    </p>

                </div>

            </article>


            {{-- Programación --}}
            <article
                id="programacion"
                class="detail-editorial-block detail-editorial-schedule"
            >

                <header class="detail-editorial-heading">

                    <span class="section-label">
                        Programación
                    </span>

                    <h2>
                        Fechas y horarios
                    </h2>

                    <p>
                        Consulta las sesiones programadas para este curso.
                    </p>

                </header>

                <div class="detail-editorial-schedule-list">

                    @forelse($curso->programaciones as $programacion)

                        <article class="detail-editorial-session">

                            <div class="detail-editorial-session-date">

                                <strong>
                                    {{ \Carbon\Carbon::parse(
                                        $programacion->fecha
                                    )->format('d') }}
                                </strong>

                                <span>
                                    {{ strtoupper(
                                        \Carbon\Carbon::parse(
                                            $programacion->fecha
                                        )->locale('es')->translatedFormat('M')
                                    ) }}
                                </span>

                            </div>

                            <div class="detail-editorial-session-content">

                                <span class="detail-editorial-session-label">
                                    Sesión programada
                                </span>

                                <h3>
                                    {{ ucfirst(
                                        \Carbon\Carbon::parse(
                                            $programacion->fecha
                                        )->locale('es')->translatedFormat(
                                            'l, d \d\e F \d\e Y'
                                        )
                                    ) }}
                                </h3>

                                <div class="detail-editorial-session-time">

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
                                        De
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

                            <span class="detail-editorial-session-status">

                                <i></i>

                                Programada

                            </span>

                        </article>

                    @empty

                        <div class="detail-editorial-empty">

                            <span class="detail-editorial-empty-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="16"
                                        rx="2"
                                    />

                                    <path d="M16 3v4M8 3v4M3 10h18"/>
                                    <path d="M9 15h6"/>
                                </svg>

                            </span>

                            <strong>
                                No hay fechas programadas
                            </strong>

                            <p>
                                Próximamente se publicarán las fechas y
                                los horarios correspondientes a este curso.
                            </p>

                        </div>

                    @endforelse

                </div>

            </article>

        </main>


        {{-- =================================================
             RESUMEN LATERAL
        ================================================== --}}

        <aside class="detail-editorial-sidebar">

            <article class="detail-editorial-summary">

                <header class="detail-editorial-summary-heading">

                    <span class="section-label">
                        Resumen
                    </span>

                    <h2>
                        Información del curso
                    </h2>

                </header>

                <div class="detail-editorial-summary-list">

                    <div class="detail-editorial-summary-item">

                        <span>Duración</span>

                        <strong>
                            {{ $curso->duracion }}
                        </strong>

                    </div>

                    <div class="detail-editorial-summary-item">

                        <span>Fecha de inicio</span>

                        <strong>
                            {{ \Carbon\Carbon::parse($curso->fecha_inicio)
                                ->locale('es')
                                ->translatedFormat('d \d\e F \d\e Y') }}
                        </strong>

                    </div>

                    <div class="detail-editorial-summary-item">

                        <span>Fecha de término</span>

                        <strong>
                            {{ \Carbon\Carbon::parse($curso->fecha_fin)
                                ->locale('es')
                                ->translatedFormat('d \d\e F \d\e Y') }}
                        </strong>

                    </div>

                    <div class="detail-editorial-summary-item">

                        <span>Cupo máximo</span>

                        <strong>
                            {{ $curso->cupo_maximo }} lugares
                        </strong>

                    </div>

                    <div class="detail-editorial-summary-item">

                        <span>Modalidad</span>

                        <strong>
                            Presencial
                        </strong>

                    </div>

                    <div class="detail-editorial-summary-item">

                        <span>Sede</span>

                        <strong>
                            Jardín Filosófico
                        </strong>

                    </div>

                </div>

                <div class="detail-editorial-availability">

                    <div>

                        <span>
                            Estado de inscripción
                        </span>

                        <strong>
                            Inscripciones disponibles
                        </strong>

                    </div>

                    <span class="detail-editorial-availability-badge">

                        <i></i>

                        Disponible

                    </span>

                </div>

                <a
                    href="{{ route('publico.inscripcion', $curso) }}"
                    class="public-button detail-editorial-register"
                >
                    Inscribirme en el curso

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M5 12h14"/>
                        <path d="m13 6 6 6-6 6"/>
                    </svg>
                </a>

                <p class="detail-editorial-register-note">
                    El registro es gratuito y solo toma unos minutos.
                </p>

            </article>

            <div class="detail-editorial-help">

                <span class="detail-editorial-help-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M9.5 9a2.5 2.5 0 1 1 3.4 2.3c-.9.4-.9 1-.9 1.7"/>
                        <path d="M12 17h.01"/>
                    </svg>

                </span>

                <div>

                    <strong>
                        ¿Tienes alguna duda?
                    </strong>

                    <p>
                        Verifica las fechas y los horarios antes de
                        completar tu inscripción.
                    </p>

                </div>

            </div>

        </aside>

    </div>

</section>

@endsection