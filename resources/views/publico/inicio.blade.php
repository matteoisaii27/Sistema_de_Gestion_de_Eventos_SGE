@extends('layouts.publico')

@section('title', 'Jardín Filosófico | Parque Cancún')

@section('content')

<section class="home-editorial-hero">

    <div class="home-editorial-hero-grid">

        <div class="home-editorial-copy">

            <h1>
                Un espacio para aprender,
                <span>
                    dialogar y descubrir nuevas ideas.
                </span>
            </h1>

            <div class="home-editorial-line"></div>

            <p>
                Cursos y talleres para todas las edades en un entorno
                único donde la filosofía, la cultura y la naturaleza
                se encuentran.
            </p>

            <div class="home-editorial-actions">

                <a
                    href="{{ route('publico.cursos') }}"
                    class="home-editorial-primary-button"
                >
                    Explorar cursos

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
                    href="{{ route('publico.calendario') }}"
                    class="home-editorial-secondary-link"
                >
                    Consultar calendario

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

        <div class="home-editorial-visual">

            @if(!empty($configuracion->imagen_principal))

                <img
                    src="{{ asset(
                        'storage/'.$configuracion->imagen_principal
                    ) }}"
                    alt="Jardín Filosófico de Parque Cancún"
                    class="home-editorial-image"
                >

            @else

                <div class="home-editorial-placeholder">

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

                        <circle
                            cx="8.5"
                            cy="9"
                            r="1.5"
                        />

                        <path
                            d="m4 17 5-5 4 4 2-2 5 5"
                        />
                    </svg>

                    <span>
                        Imagen principal del Jardín Filosófico
                    </span>

                </div>

            @endif

        </div>

    </div>

</section>
<section class="home-introduction">

    <div class="public-container home-introduction-grid">

        <div class="home-introduction-heading">

            <span class="section-label">
                Sobre el Jardín Filosófico
            </span>

            <h2>
                Un espacio para compartir conocimiento,
                dialogar y fortalecer la comunidad.
            </h2>

        </div>

        <div class="home-introduction-content">

            <p class="home-introduction-lead">
                El Jardín Filosófico de Parque Cancún reúne cursos,
                talleres y actividades dirigidas a personas interesadas
                en aprender, intercambiar ideas y participar en
                experiencias formativas.
            </p>

            <p>
                Cada actividad busca generar espacios de convivencia,
                reflexión y aprendizaje mediante programas impartidos
                por especialistas, fomentando el pensamiento crítico y
                el desarrollo personal dentro de un entorno natural.
            </p>

            <div class="home-values-grid">

                <article class="home-value-card">

                    <span class="home-value-icon value-turquoise">

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

                    <div>

                        <strong>
                            Aprendizaje
                        </strong>

                        <p>
                            Cursos y talleres enfocados en ampliar
                            conocimientos mediante actividades
                            participativas.
                        </p>

                    </div>

                </article>

                <article class="home-value-card">

                    <span class="home-value-icon value-purple">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                            <path d="M8 9h8M8 13h5"/>
                        </svg>

                    </span>

                    <div>

                        <strong>
                            Diálogo
                        </strong>

                        <p>
                            Un ambiente abierto para compartir ideas,
                            escuchar diferentes perspectivas y aprender
                            en comunidad.
                        </p>

                    </div>

                </article>

            </div>

        </div>

    </div>

</section>

<section class="home-courses-section">

    <div class="public-container">

        <div class="home-section-heading">

            <div>

                <span class="section-label">
                    Próximos cursos
                </span>

                <h2>
                    Explora las actividades disponibles
                </h2>

                <p>
                    Consulta los cursos actualmente disponibles e
                    inscríbete fácilmente en la actividad de tu interés.
                </p>

            </div>

            <a
                href="{{ route('publico.cursos') }}"
                class="public-button public-button-secondary"
            >
                Ver todos los cursos

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

        <div class="courses-grid home-courses-grid">

            @forelse($proximosCursos as $curso)

                <article class="course-card home-course-card">

                    <div
                        class="course-image-placeholder home-course-image"
                    >

                        @if($curso->imagen)

                            <img
                                src="{{ asset('storage/'.$curso->imagen) }}"
                                alt="{{ $curso->nombre }}"
                                class="home-course-main-image"
                            >

                        @else

                            <div
                                class="home-course-image-content"
                            >

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

                                    <circle
                                        cx="8.5"
                                        cy="9"
                                        r="1.5"
                                    />

                                    <path
                                        d="m4 17 5-5 4 4 2-2 5 5"
                                    />

                                </svg>

                                <span>
                                    Imagen del curso
                                </span>

                            </div>

                        @endif

                        <span class="home-course-status">

                            <i></i>

                            Disponible

                        </span>

                    </div>

                    <div class="course-card-content">
                                                <div class="home-course-meta">

                            @if($curso->duracion)

                                <span>

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />

                                        <path
                                            d="M12 7v5l3 2"
                                        />
                                    </svg>

                                    {{ $curso->duracion }}

                                </span>

                            @endif

                            @if($curso->cupo_maximo)

                                <span>

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                                        />

                                        <circle
                                            cx="10"
                                            cy="7"
                                            r="4"
                                        />

                                        <path
                                            d="M20 8v6"
                                        />

                                        <path
                                            d="M23 11h-6"
                                        />

                                    </svg>

                                    {{ $curso->cupo_maximo }} lugares

                                </span>

                            @endif

                        </div>

                        <h3>
                            {{ $curso->nombre }}
                        </h3>

                        @if($curso->fecha_inicio)

                            <p class="home-course-date">

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
                                        height="18"
                                        rx="2"
                                    />

                                    <path
                                        d="M16 2v4M8 2v4M3 10h18"
                                    />

                                </svg>

                                Inicia
                                {{ \Carbon\Carbon::parse($curso->fecha_inicio)->translatedFormat('d \d\e F, Y') }}

                            </p>

                        @endif

                        <p class="course-description">

                            {{ \Illuminate\Support\Str::limit($curso->descripcion, 140) }}

                        </p>

                        <div class="home-course-footer">

                            <a
                                href="{{ route('publico.detalle', $curso) }}"
                                class="home-course-link"
                            >
                                Ver detalles

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

                <div class="public-empty-state">

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
                            height="18"
                            rx="2"
                        />

                        <path
                            d="M16 2v4M8 2v4M3 10h18"
                        />

                    </svg>

                    <h3>
                        No hay cursos disponibles
                    </h3>

                    <p>
                        Próximamente se publicarán nuevas actividades
                        para el Jardín Filosófico.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

<section class="home-calendar-section">

    <div class="public-container">

        <div class="home-calendar-banner">

            <div>

                <span class="section-label">
                    Calendario
                </span>

                <h2>
                    Consulta las próximas fechas
                </h2>

                <p>
                    Revisa el calendario completo para conocer las
                    sesiones programadas y planificar tu participación.
                </p>

            </div>

            <a
                href="{{ route('publico.calendario') }}"
                class="public-button"
            >
                Ver calendario completo

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

</section>

@endsection