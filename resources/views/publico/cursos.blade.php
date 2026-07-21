@extends('layouts.publico')

@section('title', 'Cursos Disponibles | Jardín Filosófico')

@section('content')

<section class="courses-hero">

    <div class="public-container">

        <span class="section-label">
            Jardín Filosófico
        </span>

        <h1>Nuestros cursos</h1>

        <p>
            Explora los cursos y talleres disponibles,
            consulta sus fechas y regístrate en el que más te interese.
        </p>

    </div>

</section>

<section class="courses-section">

    <div class="public-container">

        <div class="courses-grid">

            @forelse($cursos as $curso)

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
                                145
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
                        No hay cursos disponibles por el momento
                    </strong>

                    <p>
                        Próximamente se publicarán nuevas actividades.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection