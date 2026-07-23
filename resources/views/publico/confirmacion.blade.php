@extends('layouts.publico')

@section('title', 'Inscripción confirmada | Jardín Filosófico')

@section('content')

@php
    $fechaRegistro = \Carbon\Carbon::parse(
        $inscripcion->fecha_registro
    );

    $fechaInicio = $inscripcion->curso->fecha_inicio
        ? \Carbon\Carbon::parse(
            $inscripcion->curso->fecha_inicio
        )
        : null;

    $fechaFin = $inscripcion->curso->fecha_fin
        ? \Carbon\Carbon::parse(
            $inscripcion->curso->fecha_fin
        )
        : null;
@endphp


{{-- =====================================================
     ENCABEZADO DE CONFIRMACIÓN
===================================================== --}}

<section class="confirmation-editorial-hero">

    <div class="public-container">

        <div class="confirmation-editorial-heading">

            <span class="confirmation-editorial-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="m5 12 4 4L19 6"/>
                </svg>

            </span>

            <span class="confirmation-editorial-eyebrow">
                Registro completado
            </span>

            <h1>
                Inscripción confirmada
            </h1>

            <p>
                Tu registro se realizó correctamente.
                Hemos reservado tu lugar en el curso
                <strong>
                    {{ $inscripcion->curso->nombre }}
                </strong>.
            </p>

        </div>

    </div>

</section>


{{-- =====================================================
     CONTENIDO PRINCIPAL
===================================================== --}}

<section class="confirmation-editorial-section">

    <div class="public-container confirmation-editorial-layout">

        {{-- =================================================
             INFORMACIÓN DEL REGISTRO
        ================================================== --}}

        <main class="confirmation-editorial-main">

            <article class="confirmation-editorial-card">

                <header class="confirmation-editorial-card-heading">

                    <div>

                        <span class="section-label">
                            Resumen
                        </span>

                        <h2>
                            Datos de la inscripción
                        </h2>

                        <p>
                            Revisa que la información registrada sea correcta.
                        </p>

                    </div>

                    <span class="confirmation-editorial-status">

                        <i></i>

                        {{ ucfirst($inscripcion->estado) }}

                    </span>

                </header>


                <div class="confirmation-editorial-details">

                    {{-- Curso --}}

                    <div class="confirmation-editorial-detail">

                        <span class="confirmation-editorial-detail-icon">

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
                            <span>Curso</span>

                            <strong>
                                {{ $inscripcion->curso->nombre }}
                            </strong>
                        </div>

                    </div>


                    {{-- Asistente --}}

                    <div class="confirmation-editorial-detail">

                        <span class="confirmation-editorial-detail-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21a8 8 0 0 1 16 0"/>
                            </svg>

                        </span>

                        <div>
                            <span>Asistente</span>

                            <strong>
                                {{ $inscripcion->asistente->nombre }}
                            </strong>
                        </div>

                    </div>


                    {{-- Correo --}}

                    <div class="confirmation-editorial-detail">

                        <span class="confirmation-editorial-detail-icon">

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
                                    height="14"
                                    rx="2"
                                />

                                <path d="m3 7 9 6 9-6"/>
                            </svg>

                        </span>

                        <div>
                            <span>Correo electrónico</span>

                            <strong>
                                {{ $inscripcion->asistente->correo }}
                            </strong>
                        </div>

                    </div>


                    {{-- Teléfono opcional --}}

                    @if($inscripcion->asistente->telefono)

                        <div class="confirmation-editorial-detail">

                            <span class="confirmation-editorial-detail-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.8 12.8 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.8 12.8 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>

                            </span>

                            <div>
                                <span>Teléfono</span>

                                <strong>
                                    {{ $inscripcion->asistente->telefono }}
                                </strong>
                            </div>

                        </div>

                    @endif


                    {{-- Fecha del registro --}}

                    <div class="confirmation-editorial-detail">

                        <span class="confirmation-editorial-detail-icon">

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
                            <span>Fecha de inscripción</span>

                            <strong>
                                {{ ucfirst(
                                    $fechaRegistro
                                        ->locale('es')
                                        ->translatedFormat(
                                            'd \d\e F \d\e Y · H:i'
                                        )
                                ) }}
                            </strong>
                        </div>

                    </div>

                </div>

            </article>


            {{-- =================================================
                 AVISO DE CORREO
            ================================================== --}}

            <div class="confirmation-editorial-email">

                <span class="confirmation-editorial-email-icon">

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
                            height="14"
                            rx="2"
                        />

                        <path d="m3 7 9 6 9-6"/>
                        <path d="m16 16 2 2 3-3"/>
                    </svg>

                </span>

                <div>

                    <strong>
                        Revisa tu correo electrónico
                    </strong>

                    <p>
                        Enviamos la confirmación a
                        <strong>
                            {{ $inscripcion->asistente->correo }}
                        </strong>.
                        Si no encuentras el mensaje, revisa la carpeta
                        de correo no deseado o spam.
                    </p>

                </div>

            </div>


            {{-- =================================================
                 PROCESO DE LA INSCRIPCIÓN
            ================================================== --}}

            <article class="confirmation-editorial-process">

                <header class="confirmation-editorial-process-heading">

                    <span class="section-label">
                        Próximos pasos
                    </span>

                    <h2>
                        Seguimiento de tu inscripción
                    </h2>

                    <p>
                        Estos son los mensajes que recibirás antes
                        de la fecha del curso.
                    </p>

                </header>


                <div class="confirmation-editorial-timeline">

                    <div class="confirmation-editorial-timeline-item is-complete">

                        <span class="confirmation-editorial-timeline-marker">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path d="m5 12 4 4L19 6"/>
                            </svg>

                        </span>

                        <div>
                            <strong>
                                Inscripción realizada
                            </strong>

                            <p>
                                Tus datos fueron registrados correctamente.
                            </p>
                        </div>

                    </div>


                    <div class="confirmation-editorial-timeline-item is-complete">

                        <span class="confirmation-editorial-timeline-marker">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path d="m5 12 4 4L19 6"/>
                            </svg>

                        </span>

                        <div>
                            <strong>
                                Correo de confirmación
                            </strong>

                            <p>
                                La información fue enviada al correo registrado.
                            </p>
                        </div>

                    </div>


                    <div class="confirmation-editorial-timeline-item">

                        <span class="confirmation-editorial-timeline-marker">

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
                            <strong>
                                Recordatorio siete días antes
                            </strong>

                            <p>
                                Recibirás un aviso previo a la actividad.
                            </p>
                        </div>

                    </div>


                    <div class="confirmation-editorial-timeline-item">

                        <span class="confirmation-editorial-timeline-marker">

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
                            <strong>
                                Recordatorio un día antes
                            </strong>

                            <p>
                                Recibirás el último aviso antes del curso.
                            </p>
                        </div>

                    </div>


                    <div class="confirmation-editorial-timeline-item">

                        <span class="confirmation-editorial-timeline-marker">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"/>
                                <circle cx="12" cy="10" r="2"/>
                            </svg>

                        </span>

                        <div>
                            <strong>
                                Asistencia al curso
                            </strong>

                            <p>
                                Preséntate en la fecha y horario programados.
                            </p>
                        </div>

                    </div>

                </div>

            </article>

        </main>


        {{-- =================================================
             RESUMEN DEL CURSO
        ================================================== --}}

        <aside class="confirmation-editorial-sidebar">

            <article class="confirmation-editorial-course">

                <header class="confirmation-editorial-course-heading">

                    <span class="section-label">
                        Curso registrado
                    </span>

                    <h2>
                        {{ $inscripcion->curso->nombre }}
                    </h2>

                </header>


                <div class="confirmation-editorial-course-data">

                    @if($fechaInicio)

                        <div class="confirmation-editorial-course-item">

                            <span>Fecha de inicio</span>

                            <strong>
                                {{ ucfirst(
                                    $fechaInicio
                                        ->locale('es')
                                        ->translatedFormat(
                                            'd \d\e F \d\e Y'
                                        )
                                ) }}
                            </strong>

                        </div>

                    @endif


                    @if($fechaFin)

                        <div class="confirmation-editorial-course-item">

                            <span>Fecha de término</span>

                            <strong>
                                {{ ucfirst(
                                    $fechaFin
                                        ->locale('es')
                                        ->translatedFormat(
                                            'd \d\e F \d\e Y'
                                        )
                                ) }}
                            </strong>

                        </div>

                    @endif


                    <div class="confirmation-editorial-course-item">

                        <span>Duración</span>

                        <strong>
                            {{ $inscripcion->curso->duracion }}
                        </strong>

                    </div>


                    <div class="confirmation-editorial-course-item">

                        <span>Modalidad</span>

                        <strong>
                            Presencial
                        </strong>

                    </div>


                    <div class="confirmation-editorial-course-item">

                        <span>Sede</span>

                        <strong>
                            Jardín Filosófico
                        </strong>

                    </div>

                </div>


                <a
                    href="{{ route(
                        'publico.detalle',
                        $inscripcion->curso
                    ) }}"
                    class="confirmation-editorial-course-link"
                >
                    Consultar información del curso

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

            </article>


            <div class="confirmation-editorial-note">

                <span class="confirmation-editorial-note-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8v4"/>
                        <path d="M12 16h.01"/>
                    </svg>

                </span>

                <div>

                    <strong>
                        Conserva tu confirmación
                    </strong>

                    <p>
                        Guarda el correo recibido para consultar
                        posteriormente los datos de tu inscripción.
                    </p>

                </div>

            </div>

        </aside>

    </div>


    {{-- =====================================================
         ACCIONES FINALES
    ====================================================== --}}

    <div class="public-container">

        <div class="confirmation-editorial-actions">

            <a
                href="{{ route('publico.inicio') }}"
                class="public-button public-button-secondary"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M3 11 12 3l9 8"/>
                    <path d="M5 10v10h14V10"/>
                    <path d="M9 20v-6h6v6"/>
                </svg>

                Volver al inicio
            </a>

            <a
                href="{{ route('publico.calendario') }}"
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

                Ver calendario
            </a>

            <a
                href="{{ route('publico.cursos') }}"
                class="public-button"
            >
                Explorar otros cursos

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