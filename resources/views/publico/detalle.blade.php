@extends('layouts.publico')

@section('title', $curso->nombre . ' | Jardín Filosófico')

@section('content')

<section class="course-detail-hero">

    <div class="public-container">

        <a
            href="{{ route('publico.cursos') }}"
            class="back-link"
        >
            ← Volver a cursos
        </a>

        <div class="course-detail-hero-grid">

            <div>

                <span class="section-label">
                    Curso disponible
                </span>

                <h1>
                    {{ $curso->nombre }}
                </h1>

                <p>
                    {{ $curso->descripcion }}
                </p>

                <div class="course-detail-actions">

                    <a
                        href="#informacion"
                        class="public-button"
                    >
                        Ver información
                    </a>

                    <a
                        href="#programacion"
                        class="public-button public-button-secondary"
                    >
                        Consultar fechas
                    </a>

                </div>

            </div>

            <div class="detail-image-placeholder">
                Imagen del curso
            </div>

        </div>

    </div>

</section>

<section
    id="informacion"
    class="course-detail-section"
>

    <div class="public-container course-detail-grid">

        <div class="detail-main">

            <article class="detail-card">

                <h2>Acerca del curso</h2>

                <p>
                    {{ $curso->descripcion }}
                </p>

            </article>

            <article
                id="programacion"
                class="detail-card"
            >

                <h2>Fechas y horarios</h2>

                <div class="schedule-list">

                    @forelse($curso->programaciones as $programacion)

                        <div class="schedule-item">

                            <div class="schedule-date">

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

                            <div class="schedule-content">

                                <strong>
                                    {{ \Carbon\Carbon::parse(
                                        $programacion->fecha
                                    )->translatedFormat(
                                        'l, d \d\e F \d\e Y'
                                    ) }}
                                </strong>

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

                    @empty

                        <div class="public-empty detail-empty">

                            <strong>
                                No hay fechas programadas
                            </strong>

                            <p>
                                Próximamente se publicarán las fechas
                                y horarios de este curso.
                            </p>

                        </div>

                    @endforelse

                </div>

            </article>

        </div>

        <aside class="detail-sidebar">

            <article class="detail-card course-summary-card">

                <h3>Información del curso</h3>

                <div class="summary-item">
                    <span>Duración</span>
                    <strong>{{ $curso->duracion }}</strong>
                </div>

                <div class="summary-item">
                    <span>Fecha de inicio</span>

                    <strong>
                        {{ \Carbon\Carbon::parse(
                            $curso->fecha_inicio
                        )->format('d/m/Y') }}
                    </strong>
                </div>

                <div class="summary-item">
                    <span>Fecha de término</span>

                    <strong>
                        {{ \Carbon\Carbon::parse(
                            $curso->fecha_fin
                        )->format('d/m/Y') }}
                    </strong>
                </div>

                <div class="summary-item">
                    <span>Cupo máximo</span>

                    <strong>
                        {{ $curso->cupo_maximo }}
                        lugares
                    </strong>
                </div>

                <div class="summary-item">
                    <span>Estado</span>

                    <strong class="available-text">
                        Disponible
                    </strong>
                </div>

                <a
    href="{{ route('publico.inscripcion', $curso) }}"
    class="public-button detail-register-button"
>
    Inscribirme
</a>

                

            </article>

        </aside>

    </div>

</section>

@endsection