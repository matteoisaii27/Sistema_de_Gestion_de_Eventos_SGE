@extends('layouts.publico')

@section('title', 'Jardín Filosófico | Parque Cancún')

@section('content')

<section class="home-hero">

    <div class="public-container home-hero-grid">

        <div class="home-hero-content">

            <span class="section-label">
                Jardín Filosófico
            </span>

            <h1>
                Espacios para aprender,
                dialogar y reflexionar
            </h1>

            <p>
                Descubre cursos, talleres y actividades diseñadas
                para fomentar el pensamiento crítico, la participación
                y el encuentro entre personas.
            </p>

            <div class="home-hero-actions">

                <a
                    href="{{ route('publico.cursos') }}"
                    class="public-button"
                >
                    Explorar cursos
                </a>

                <a
                    href="{{ route('publico.calendario') }}"
                    class="public-button public-button-secondary"
                >
                    Ver calendario
                </a>

            </div>

        </div>

        <div class="home-hero-image">
            Imagen principal del Jardín Filosófico
        </div>

    </div>

</section>

<section class="home-introduction">

    <div class="public-container home-introduction-grid">

        <div>

            <span class="section-label">
                Sobre el proyecto
            </span>

            <h2>
                Aprende mediante el diálogo
                y la participación
            </h2>

        </div>

        <div>

            <p>
                El Jardín Filosófico es un espacio de Parque Cancún
                dedicado a la reflexión, el intercambio de ideas y
                el desarrollo de actividades formativas para personas
                interesadas en ampliar sus conocimientos.
            </p>

            <p>
                A través de cursos y talleres se promueve la convivencia,
                la escucha y la construcción colectiva de aprendizajes.
            </p>

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
                    Actividades disponibles
                </h2>

                <p>
                    Consulta los cursos activos y encuentra
                    el que más se adapte a tus intereses.
                </p>
            </div>

            <a
                href="{{ route('publico.cursos') }}"
                class="public-button public-button-secondary"
            >
                Ver todos los cursos
            </a>

        </div>

        <div class="courses-grid home-courses-grid">

            @forelse($proximosCursos as $curso)

                <article class="course-card">

                    <div class="course-image-placeholder">
                        Imagen del curso
                    </div>

                    <div class="course-card-content">

                        <div class="course-card-top">

                            <span class="course-status">
                                Disponible
                            </span>

                            <span class="course-duration">
                                {{ $curso->duracion }}
                            </span>

                        </div>

                        <h2>
                            {{ $curso->nombre }}
                        </h2>

                        <p>
                            {{ \Illuminate\Support\Str::limit(
                                $curso->descripcion,
                                130
                            ) }}
                        </p>

                        <div class="course-info">

                            <span>
                                Inicio:
                                {{ \Carbon\Carbon::parse(
                                    $curso->fecha_inicio
                                )->format('d/m/Y') }}
                            </span>

                            <span>
                                Cupo:
                                {{ $curso->cupo_maximo }}
                            </span>

                        </div>

                        <a
                            href="{{ route(
                                'publico.detalle',
                                $curso
                            ) }}"
                            class="public-button"
                        >
                            Ver detalles
                        </a>

                    </div>

                </article>

            @empty

                <div class="public-empty">

                    <strong>
                        No hay cursos disponibles
                    </strong>

                    <p>
                        Próximamente se publicarán nuevas actividades.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

<section class="home-calendar-section">

    <div class="public-container home-calendar-card">

        <div>

            <span class="section-label">
                Consulta las fechas
            </span>

            <h2>
                Revisa el calendario de actividades
            </h2>

            <p>
                Conoce las fechas y horarios de las próximas sesiones
                programadas en el Jardín Filosófico.
            </p>

        </div>

        <a
            href="{{ route('publico.calendario') }}"
            class="public-button"
        >
            Consultar calendario
        </a>

    </div>

</section>

@endsection