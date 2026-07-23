@extends('layouts.publico')

@section('title', 'Cursos Disponibles | Jardín Filosófico')

@section('content')

<section class="courses-hero">

    <div class="courses-hero-shape courses-shape-one"></div>
    <div class="courses-hero-shape courses-shape-two"></div>

    <div class="public-container courses-hero-content">

        <div class="courses-hero-copy">

            <span class="courses-page-badge">

                <span class="courses-page-badge-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                        <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
                    </svg>

                </span>

                Jardín Filosófico

            </span>

            <h1>
                Encuentra una actividad
                <span>para aprender y compartir</span>
            </h1>

            <p>
                Explora los cursos y talleres disponibles,
                consulta sus fechas, duración y cupo, y regístrate
                en la actividad que más se adapte a tus intereses.
            </p>

        </div>

        <div class="courses-hero-summary">

            <div class="courses-summary-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M12 3a9 9 0 1 0 9 9"/>
                    <path d="M12 7v5l3 2"/>
                    <path d="M17 3h4v4"/>
                    <path d="m21 3-5 5"/>
                </svg>

            </div>

            <div>
                <span>Actividades publicadas</span>

                <strong>
                    {{ $cursos->count() }}
                    {{ $cursos->count() === 1 ? 'curso' : 'cursos' }}
                </strong>

                <p>
                    Consulta la información y disponibilidad
                    de cada actividad.
                </p>
            </div>

        </div>

    </div>

</section>

<section class="courses-section">

    <div class="public-container">

        <div class="courses-section-header">

            <div>

                <span class="section-label">
                    Oferta disponible
                </span>

                <h2>
                    Cursos y talleres
                </h2>

                <p>
                    Selecciona una actividad para conocer todos sus
                    detalles, sesiones programadas y proceso de inscripción.
                </p>

            </div>

            <a
                href="{{ route('publico.calendario') }}"
                class="courses-calendar-link"
            >

                <span class="courses-calendar-link-icon">

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

                <span>
                    <small>Consulta también</small>
                    <strong>Calendario de actividades</strong>
                </span>

                <svg
                    class="courses-calendar-arrow"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M5 12h14"/>
                    <path d="m13 6 6 6-6 6"/>
                </svg>

            </a>

        </div>

        <div class="courses-grid courses-page-grid">

            @forelse($cursos as $curso)

                <article class="course-card courses-page-card">

                    <div class="course-image-placeholder courses-page-image">

    @if($curso->imagen)

        <img
            src="{{ asset('storage/' . $curso->imagen) }}"
            alt="{{ $curso->nombre }}"
            style="
                width:100%;
                height:100%;
                object-fit:cover;
                position:absolute;
                inset:0;
            "
        >

    @else

        <div class="courses-image-decoration"></div>

        <div class="courses-image-placeholder-content">

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

            <span>
                Imagen del curso
            </span>

        </div>

    @endif

    <span class="courses-availability-badge">

        <i></i>

        Disponible

    </span>

    <span class="courses-duration-badge">

        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            aria-hidden="true"
        >
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </svg>

        {{ $curso->duracion }}

    </span>

</div>
                    <div class="course-card-content courses-page-card-content">

                        <div class="courses-card-heading">

                            <span class="courses-card-category">
                                Curso del Jardín Filosófico
                            </span>

                            <h2>
                                {{ $curso->nombre }}
                            </h2>

                        </div>

                        <p class="courses-card-description">
                            {{ \Illuminate\Support\Str::limit(
                                $curso->descripcion,
                                145
                            ) }}
                        </p>

                        <div class="courses-card-data">

                            <div class="courses-data-item">

                                <span class="courses-data-icon data-icon-orange">

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
                                        {{ \Carbon\Carbon::parse(
                                            $curso->fecha_inicio
                                        )->locale('es')->translatedFormat(
                                            'd \d\e F \d\e Y'
                                        ) }}
                                    </strong>
                                </div>

                            </div>

                            <div class="courses-data-item">

                                <span class="courses-data-icon data-icon-purple">

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
                                        {{ $curso->cupo_maximo }}
                                        lugares
                                    </strong>
                                </div>

                            </div>

                        </div>

                        <div class="courses-card-footer">

                            <a
                                href="{{ route(
                                    'publico.detalle',
                                    $curso
                                ) }}"
                                class="courses-detail-link"
                            >
                                Conocer el curso

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

                        </div>

                    </div>

                </article>

            @empty

                <div class="public-empty courses-empty-state">

                    <span class="courses-empty-icon">

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
                            <path d="M9 14h6"/>
                        </svg>

                    </span>

                    <span class="section-label">
                        Nuevas actividades próximamente
                    </span>

                    <strong>
                        No hay cursos disponibles por el momento
                    </strong>

                    <p>
                        Cuando se publiquen nuevos cursos y talleres,
                        podrás consultarlos e inscribirte desde esta página.
                    </p>

                    <a
                        href="{{ route('publico.calendario') }}"
                        class="public-button public-button-secondary"
                    >
                        Consultar calendario
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection