@extends('layouts.publico')

@section('title', 'Inscripción | ' . $curso->nombre)

@section('content')

@php
    $porcentajeDisponible = $curso->cupo_maximo > 0
        ? max(
            0,
            min(
                100,
                ($lugaresDisponibles / $curso->cupo_maximo) * 100
            )
        )
        : 0;

    $fechaInicio = $curso->fecha_inicio
        ? \Carbon\Carbon::parse($curso->fecha_inicio)
        : null;

    $fechaFin = $curso->fecha_fin
        ? \Carbon\Carbon::parse($curso->fecha_fin)
        : null;
@endphp


{{-- =====================================================
     ENCABEZADO DE INSCRIPCIÓN
===================================================== --}}

<section class="registration-editorial-hero">

    <div class="public-container">

        <a
            href="{{ route('publico.detalle', $curso) }}"
            class="registration-editorial-back"
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

            Volver al curso
        </a>

        <div class="registration-editorial-heading">

            <div>

                <span class="registration-editorial-eyebrow">
                    Registro de asistente
                </span>

                <h1>
                    Inscripción al curso
                </h1>

                <p>
                    Completa el formulario para reservar tu lugar en
                    <strong>{{ $curso->nombre }}</strong>.
                </p>

            </div>

            <div class="registration-editorial-step">

                <span>Proceso de registro</span>

                <strong>
                    Paso 1 de 1
                </strong>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     CONTENIDO PRINCIPAL
===================================================== --}}

<section class="registration-editorial-section">

    <div class="public-container registration-editorial-layout">

        {{-- =================================================
             RESUMEN DEL CURSO
        ================================================== --}}

        <aside class="registration-editorial-sidebar">

            <article class="registration-editorial-course">

                <header class="registration-editorial-course-heading">

                    <span class="section-label">
                        Curso seleccionado
                    </span>

                    <h2>
                        {{ $curso->nombre }}
                    </h2>

                </header>

                <div class="registration-editorial-course-data">

                    <div class="registration-editorial-data-item">

                        <span class="registration-editorial-data-icon">

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

                            <strong>
                                {{ $curso->duracion }}
                            </strong>
                        </div>

                    </div>

                    @if($fechaInicio)

                        <div class="registration-editorial-data-item">

                            <span class="registration-editorial-data-icon">

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
                                    {{ ucfirst(
                                        $fechaInicio
                                            ->locale('es')
                                            ->translatedFormat(
                                                'd \d\e F \d\e Y'
                                            )
                                    ) }}
                                </strong>
                            </div>

                        </div>

                    @endif

                    @if($fechaFin)

                        <div class="registration-editorial-data-item">

                            <span class="registration-editorial-data-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M5 12h14"/>
                                    <path d="m13 6 6 6-6 6"/>
                                </svg>

                            </span>

                            <div>
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

                        </div>

                    @endif

                    <div class="registration-editorial-data-item">

                        <span class="registration-editorial-data-icon">

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


                {{-- Disponibilidad --}}

                <div class="registration-editorial-availability">

                    <div class="registration-editorial-availability-heading">

                        <div>
                            <span>
                                Disponibilidad
                            </span>

                            <strong>
                                {{ $lugaresDisponibles }}
                                de
                                {{ $curso->cupo_maximo }}
                                lugares
                            </strong>
                        </div>

                        @if($lugaresDisponibles <= 0)

                            <span class="registration-editorial-status is-full">
                                Completo
                            </span>

                        @elseif($lugaresDisponibles <= 5)

                            <span class="registration-editorial-status is-limited">
                                Cupo limitado
                            </span>

                        @else

                            <span class="registration-editorial-status">
                                Disponible
                            </span>

                        @endif

                    </div>

                    <div
                        class="registration-editorial-progress"
                        role="progressbar"
                        aria-label="Lugares disponibles"
                        aria-valuemin="0"
                        aria-valuemax="{{ $curso->cupo_maximo }}"
                        aria-valuenow="{{ $lugaresDisponibles }}"
                    >
                        <span
                            style="width: {{ $porcentajeDisponible }}%"
                        ></span>
                    </div>

                    @if($lugaresDisponibles <= 0)

                        <p class="registration-editorial-availability-note is-full">
                            El curso alcanzó su cupo máximo.
                        </p>

                    @elseif($lugaresDisponibles <= 5)

                        <p class="registration-editorial-availability-note is-limited">
                            Quedan pocos lugares disponibles.
                        </p>

                    @else

                        <p class="registration-editorial-availability-note">
                            Todavía puedes reservar tu lugar.
                        </p>

                    @endif

                </div>

                <a
                    href="{{ route('publico.detalle', $curso) }}"
                    class="registration-editorial-course-link"
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


            {{-- Aviso sobre el correo --}}

            <div class="registration-editorial-help">

                <span class="registration-editorial-help-icon">

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

                    <strong>
                        Verifica tu correo electrónico
                    </strong>

                    <p>
                        La confirmación y los recordatorios del curso
                        se enviarán a la dirección que registres.
                    </p>

                </div>

            </div>

        </aside>


        {{-- =================================================
             FORMULARIO
        ================================================== --}}

        <main class="registration-editorial-main">

            @if(!$inscripcionesHabilitadas)

                {{-- Inscripciones cerradas --}}

                <div class="registration-editorial-unavailable">

                    <span class="registration-editorial-unavailable-icon">

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
                            <path d="m9 15 6 6M15 15l-6 6"/>
                        </svg>

                    </span>

                    <span class="section-label">
                        Inscripción no disponible
                    </span>

                    <h2>
                        Las inscripciones están temporalmente cerradas
                    </h2>

                    <p>
                        Por el momento no es posible registrar nuevos
                        asistentes. Puedes consultar otros cursos o
                        regresar más tarde.
                    </p>

                    <div class="registration-editorial-unavailable-actions">

                        <a
                            href="{{ route('publico.cursos') }}"
                            class="public-button"
                        >
                            Ver otros cursos
                        </a>

                        <a
                            href="{{ route('publico.detalle', $curso) }}"
                            class="public-button public-button-secondary"
                        >
                            Volver al detalle
                        </a>

                    </div>

                </div>

            @elseif($lugaresDisponibles <= 0)

                {{-- Curso lleno --}}

                <div class="registration-editorial-unavailable">

                    <span class="registration-editorial-unavailable-icon is-full">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M17 8h5"/>
                        </svg>

                    </span>

                    <span class="section-label">
                        Cupo completo
                    </span>

                    <h2>
                        Este curso ya alcanzó su cupo máximo
                    </h2>

                    <p>
                        Actualmente no quedan lugares disponibles para
                        esta actividad. Consulta el catálogo para conocer
                        otros cursos.
                    </p>

                    <div class="registration-editorial-unavailable-actions">

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

            @else

                {{-- Encabezado del formulario --}}

                <article class="registration-editorial-form-card">

                    <header class="registration-editorial-form-heading">

                        <span class="registration-editorial-form-number">
                            01
                        </span>

                        <div>

                            <span>
                                Formulario de inscripción
                            </span>

                            <h2>
                                Datos del asistente
                            </h2>

                            <p>
                                Los campos marcados con un asterisco
                                son obligatorios.
                            </p>

                        </div>

                    </header>


                    {{-- Error general --}}

                    @if($errors->has('inscripcion'))

                        <div class="public-alert public-alert-error">

                            <span class="public-alert-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 8v5"/>
                                    <path d="M12 16h.01"/>
                                </svg>

                            </span>

                            <div>

                                <strong>
                                    No fue posible completar la inscripción
                                </strong>

                                <p>
                                    {{ $errors->first('inscripcion') }}
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- Formulario --}}

                    <form
                        action="{{ route(
                            'publico.inscripcion.guardar',
                            $curso
                        ) }}"
                        method="POST"
                        class="public-form registration-editorial-form"
                    >
                        @csrf


                        {{-- Nombre completo --}}

                        <div class="public-form-group">

                            <label for="nombre">
                                Nombre completo

                                <span class="required-mark">
                                    *
                                </span>
                            </label>

                            <div class="public-input-wrapper">

                                <span class="public-input-icon">

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

                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    value="{{ old('nombre') }}"
                                    placeholder="Escribe tu nombre completo"
                                    autocomplete="name"
                                    maxlength="150"
                                    required
                                    class="{{ $errors->has('nombre')
                                        ? 'has-error'
                                        : '' }}"
                                >

                            </div>

                            @error('nombre')

                                <small class="public-form-error">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M12 8v5"/>
                                        <path d="M12 16h.01"/>
                                    </svg>

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>


                        {{-- Correos electrónicos --}}

                        <div class="registration-editorial-form-row">

                            <div class="public-form-group">

                                <label for="correo">
                                    Correo electrónico

                                    <span class="required-mark">
                                        *
                                    </span>
                                </label>

                                <div class="public-input-wrapper">

                                    <span class="public-input-icon">

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

                                    <input
                                        type="email"
                                        id="correo"
                                        name="correo"
                                        value="{{ old('correo') }}"
                                        placeholder="ejemplo@correo.com"
                                        autocomplete="email"
                                        maxlength="150"
                                        required
                                        class="{{ $errors->has('correo')
                                            ? 'has-error'
                                            : '' }}"
                                    >

                                </div>

                                @error('correo')

                                    <small class="public-form-error">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <circle cx="12" cy="12" r="9"/>
                                            <path d="M12 8v5"/>
                                            <path d="M12 16h.01"/>
                                        </svg>

                                        {{ $message }}

                                    </small>

                                @enderror

                            </div>


                            <div class="public-form-group">

                                <label for="correo_confirmation">
                                    Confirmar correo

                                    <span class="required-mark">
                                        *
                                    </span>
                                </label>

                                <div class="public-input-wrapper">

                                    <span class="public-input-icon">

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
                                            <path d="m16 15 2 2 3-3"/>
                                        </svg>

                                    </span>

                                    <input
                                        type="email"
                                        id="correo_confirmation"
                                        name="correo_confirmation"
                                        value="{{ old(
                                            'correo_confirmation'
                                        ) }}"
                                        placeholder="Repite tu correo"
                                        autocomplete="email"
                                        maxlength="150"
                                        required
                                        class="{{ $errors->has(
                                            'correo_confirmation'
                                        ) ? 'has-error' : '' }}"
                                    >

                                </div>

                                @error('correo_confirmation')

                                    <small class="public-form-error">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <circle cx="12" cy="12" r="9"/>
                                            <path d="M12 8v5"/>
                                            <path d="M12 16h.01"/>
                                        </svg>

                                        Los correos electrónicos no coinciden.

                                    </small>

                                @enderror

                            </div>

                        </div>


                        {{-- Teléfono --}}

                        <div class="public-form-group">

                            <label for="telefono">
                                Teléfono

                                <span class="optional-mark">
                                    Opcional
                                </span>
                            </label>

                            <div class="public-input-wrapper">

                                <span class="public-input-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.8 12.8 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.8 12.8 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>

                                </span>

                                <input
                                    type="tel"
                                    id="telefono"
                                    name="telefono"
                                    value="{{ old('telefono') }}"
                                    placeholder="Ejemplo: 998 123 4567"
                                    autocomplete="tel"
                                    maxlength="20"
                                    inputmode="tel"
                                    class="{{ $errors->has('telefono')
                                        ? 'has-error'
                                        : '' }}"
                                >

                            </div>

                            <small class="public-form-help">
                                Puedes incluir lada o código de país.
                            </small>

                            @error('telefono')

                                <small class="public-form-error">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M12 8v5"/>
                                        <path d="M12 16h.01"/>
                                    </svg>

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>


                        {{-- Aviso de confirmación --}}

                        <div class="registration-editorial-notice">

                            <span class="registration-editorial-notice-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>

                            </span>

                            <div>

                                <strong>
                                    Revisa tus datos antes de continuar
                                </strong>

                                <p>
                                    Al confirmar, se registrará tu lugar
                                    y recibirás la información correspondiente
                                    en el correo proporcionado.
                                </p>

                            </div>

                        </div>


                        {{-- Acciones --}}

                        <div class="registration-editorial-actions">

                            <a
                                href="{{ route(
                                    'publico.detalle',
                                    $curso
                                ) }}"
                                class="public-button public-button-secondary"
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

                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="public-button public-submit-button"
                            >
                                Confirmar inscripción

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M5 12h14"/>
                                    <path d="m13 6 6 6-6 6"/>
                                </svg>
                            </button>

                        </div>

                    </form>

                </article>

            @endif

        </main>

    </div>

</section>

@endsection