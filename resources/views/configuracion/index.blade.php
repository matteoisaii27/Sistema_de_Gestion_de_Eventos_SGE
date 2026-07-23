@extends('layouts.admin')

@section('title', 'Configuración | SGE')
@section('page-title', 'Configuración')

@section('content')

@php
    $inscripcionesActivas = (bool) old(
        'inscripciones_habilitadas',
        $configuracion->inscripciones_habilitadas
    );

    $ultimaActualizacion = $configuracion->fecha_actualizacion
        ?? $configuracion->updated_at
        ?? null;
@endphp

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Preferencias del sistema
        </span>

        <h1>Configuración del sistema</h1>

        <p>
            Administra la información general, los mensajes automáticos
            y la disponibilidad del registro público.
        </p>
    </div>

    <div class="configuration-heading-status">

        <span class="configuration-status-label">
            Estado del registro
        </span>

        @if($inscripcionesActivas)

            <span class="configuration-status configuration-status-enabled">
                <i></i>
                Inscripciones abiertas
            </span>

        @else

            <span class="configuration-status configuration-status-disabled">
                <i></i>
                Inscripciones cerradas
            </span>

        @endif

    </div>

</div>

<section class="configuration-summary">

    <article class="configuration-summary-card summary-turquoise">

        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-2.83 2.83-.06-.06A1.7 1.7 0 0 0 15 19.4a1.7 1.7 0 0 0-1 .6 1.7 1.7 0 0 0-.4 1.1V21H9.6v-.1A1.7 1.7 0 0 0 8.6 19.4a1.7 1.7 0 0 0-1.88.34l-.06.06-2.83-2.83.06-.06A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-.6-1 1.7 1.7 0 0 0-1.1-.4H3V9.6h.1A1.7 1.7 0 0 0 4.6 8.6a1.7 1.7 0 0 0-.34-1.88l-.06-.06 2.83-2.83.06.06A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-.6 1.7 1.7 0 0 0 .4-1.1V3h4v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.88-.34l.06-.06 2.83 2.83-.06.06A1.7 1.7 0 0 0 19.4 9a1.7 1.7 0 0 0 .6 1 1.7 1.7 0 0 0 1.1.4h.1v4h-.1a1.7 1.7 0 0 0-1.7.6z"/>
            </svg>
        </div>

        <div>
            <span>Configuración</span>
            <strong>General</strong>
        </div>

    </article>

    <article class="configuration-summary-card summary-purple">

        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <rect x="3" y="5" width="18" height="14" rx="2"/>
                <path d="M3 7l9 6 9-6"/>
            </svg>
        </div>

        <div>
            <span>Mensajes automáticos</span>
            <strong>2 plantillas</strong>
        </div>

    </article>

    <article class="configuration-summary-card summary-orange">

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
            <span>Última actualización</span>

            <strong>
                {{ $ultimaActualizacion
                    ? \Carbon\Carbon::parse($ultimaActualizacion)->format('d/m/Y')
                    : 'Sin registro' }}
            </strong>
        </div>

    </article>

</section>

<form
    action="{{ route('configuracion.update', $configuracion) }}"
    method="POST"
    enctype="multipart/form-data"
    class="configuration-form"
>
    @csrf
    @method('PUT')

    <div class="configuration-layout">

        <div class="configuration-main">

            <section class="card configuration-card">

                <div class="configuration-card-header">

                    <div class="configuration-section-icon configuration-icon-turquoise">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M4 21v-7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v7"/>
                            <path d="M8 21v-5h8v5"/>
                            <path d="M6 12V6l6-3 6 3v6"/>
                            <path d="M9 9h6"/>
                        </svg>
                    </div>

                    <div>
                        <span class="panel-kicker panel-kicker-turquoise">
                            Identidad
                        </span>

                        <h3>Información general</h3>

                        <p>
                            Estos datos identifican al sistema y proporcionan
                            la información oficial de contacto.
                        </p>
                    </div>

                </div>

                <div class="configuration-card-content">

                    <div class="form-grid">

                        <div class="form-group form-group-full">
                            <label for="nombre_sistema">
                                Nombre del sistema
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-with-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M4 21v-7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v7"/>
                                    <path d="M6 12V6l6-3 6 3v6"/>
                                </svg>

                                <input
                                    type="text"
                                    id="nombre_sistema"
                                    name="nombre_sistema"
                                    maxlength="150"
                                    value="{{ old(
                                        'nombre_sistema',
                                        $configuracion->nombre_sistema
                                    ) }}"
                                    placeholder="Sistema de Gestión de Eventos"
                                    required
                                >
                            </div>

                            <small class="field-help">
                                Este nombre puede utilizarse en encabezados,
                                correos y mensajes del sistema.
                            </small>

                            @error('nombre_sistema')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="correo_contacto">
                                Correo de contacto
                            </label>

                            <div class="input-with-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="M3 7l9 6 9-6"/>
                                </svg>

                                <input
                                    type="email"
                                    id="correo_contacto"
                                    name="correo_contacto"
                                    maxlength="150"
                                    value="{{ old(
                                        'correo_contacto',
                                        $configuracion->correo_contacto
                                    ) }}"
                                    placeholder="contacto@parquecancun.org"
                                >
                            </div>

                            @error('correo_contacto')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telefono_contacto">
                                Teléfono de contacto
                            </label>

                            <div class="input-with-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M5 4h4l2 5-3 2a15 15 0 0 0 5 5l2-3 5 2v4a2 2 0 0 1-2 2C10 21 3 14 3 6a2 2 0 0 1 2-2z"/>
                                </svg>

                                <input
                                    type="text"
                                    id="telefono_contacto"
                                    name="telefono_contacto"
                                    maxlength="20"
                                    value="{{ old(
                                        'telefono_contacto',
                                        $configuracion->telefono_contacto
                                    ) }}"
                                    placeholder="998 000 0000"
                                >
                            </div>

                            @error('telefono_contacto')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group form-group-full">
                            <label for="direccion">
                                Dirección
                            </label>

                            <div class="input-with-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"/>
                                    <circle cx="12" cy="10" r="2.5"/>
                                </svg>

                                <input
                                    type="text"
                                    id="direccion"
                                    name="direccion"
                                    maxlength="255"
                                    value="{{ old(
                                        'direccion',
                                        $configuracion->direccion
                                    ) }}"
                                    placeholder="Dirección del Jardín Filosófico"
                                >
                            </div>

                            @error('direccion')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>

                </div>

            </section>

            <section class="card configuration-card">

                <div class="configuration-card-header">

                    <div class="configuration-section-icon configuration-icon-purple">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="M3 7l9 6 9-6"/>
                        </svg>
                    </div>

                    <div>
                        <span class="panel-kicker panel-kicker-purple">
                            Comunicaciones
                        </span>

                        <h3>Mensajes automáticos</h3>

                        <p>
                            Define el contenido base de los correos enviados
                            durante el proceso de inscripción.
                        </p>
                    </div>

                </div>

                <div class="configuration-card-content">

                    <div class="configuration-message-grid">

                        <div class="form-group configuration-message-field">

                            <div class="configuration-message-label">

                                <div>
                                    <label for="mensaje_confirmacion">
                                        Mensaje de confirmación
                                    </label>

                                    <small>
                                        Se utiliza después de completar
                                        una inscripción.
                                    </small>
                                </div>

                                <span class="message-type-badge message-type-confirmation">
                                    Confirmación
                                </span>

                            </div>

                            <textarea
                                id="mensaje_confirmacion"
                                name="mensaje_confirmacion"
                                rows="8"
                                maxlength="1000"
                                placeholder="Escribe el mensaje que recibirá el asistente al completar su inscripción."
                            >{{ old(
                                'mensaje_confirmacion',
                                $configuracion->mensaje_confirmacion
                            ) }}</textarea>

                            <div class="textarea-footer">
                                <span>
                                    Máximo 1000 caracteres
                                </span>

                                <span
                                    id="confirmation-counter"
                                    class="character-counter"
                                >
                                    0 / 1000
                                </span>
                            </div>

                            @error('mensaje_confirmacion')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group configuration-message-field">

                            <div class="configuration-message-label">

                                <div>
                                    <label for="mensaje_recordatorio">
                                        Mensaje de recordatorio
                                    </label>

                                    <small>
                                        Se utiliza antes de la fecha
                                        programada del curso.
                                    </small>
                                </div>

                                <span class="message-type-badge message-type-reminder">
                                    Recordatorio
                                </span>

                            </div>

                            <textarea
                                id="mensaje_recordatorio"
                                name="mensaje_recordatorio"
                                rows="8"
                                maxlength="1000"
                                placeholder="Escribe el mensaje que se enviará antes del curso."
                            >{{ old(
                                'mensaje_recordatorio',
                                $configuracion->mensaje_recordatorio
                            ) }}</textarea>

                            <div class="textarea-footer">
                                <span>
                                    Máximo 1000 caracteres
                                </span>

                                <span
                                    id="reminder-counter"
                                    class="character-counter"
                                >
                                    0 / 1000
                                </span>
                            </div>

                            @error('mensaje_recordatorio')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>

                </div>

            </section>

            <section class="card configuration-card">

    <div class="configuration-card-header">

        <div class="configuration-section-icon configuration-icon-turquoise">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
            >
                <rect x="3" y="5" width="18" height="14" rx="2"/>
                <circle cx="8" cy="9" r="2"/>
                <path d="M21 16l-5-5-5 6-2-2-6 6"/>
            </svg>

        </div>

        <div>

            <span class="panel-kicker panel-kicker-turquoise">
                Apariencia
            </span>

            <h3>Imagen principal del Jardín Filosófico</h3>

            <p>
                Esta imagen se mostrará en la portada del sitio público.
            </p>

        </div>

    </div>

    <div class="configuration-card-content">

        @if($configuracion->imagen_principal)

            <div style="margin-bottom:20px;">

                <img
                    src="{{ asset('storage/'.$configuracion->imagen_principal) }}"
                    alt="Imagen principal"
                    style="
                        width:100%;
                        max-width:700px;
                        height:260px;
                        object-fit:cover;
                        border-radius:18px;
                        border:1px solid #e5e7eb;
                    "
                >

            </div>

        @endif

        <div class="form-group">

            <label for="imagen_principal">

                Imagen principal

            </label>

            <input
                type="file"
                id="imagen_principal"
                name="imagen_principal"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <small class="field-help">

                JPG, PNG o WEBP.
                Máximo 5 MB.

            </small>

            @error('imagen_principal')

                <span class="form-error">

                    {{ $message }}

                </span>

            @enderror

        </div>

    </div>

</section>

            <section class="card configuration-card">

                <div class="configuration-card-header">

                    <div class="configuration-section-icon configuration-icon-orange">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                            <circle cx="12" cy="12" r="4"/>
                        </svg>
                    </div>

                    <div>
                        <span class="panel-kicker panel-kicker-orange">
                            Sitio público
                        </span>

                        <h3>Disponibilidad de inscripciones</h3>

                        <p>
                            Controla si los visitantes pueden utilizar
                            el formulario público de registro.
                        </p>
                    </div>

                </div>

                <div class="configuration-card-content">

                    <div
                        class="configuration-switch-card
                        {{ $inscripcionesActivas
                            ? 'configuration-switch-enabled'
                            : 'configuration-switch-disabled' }}"
                        id="registration-switch-card"
                    >

                        <div class="configuration-switch-information">

                            <div
                                class="configuration-switch-icon"
                                id="registration-switch-icon"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="9" cy="8" r="4"/>
                                    <path d="M2.5 21a6.5 6.5 0 0 1 13 0"/>
                                    <path d="M17 8h5M19.5 5.5v5"/>
                                </svg>
                            </div>

                            <div>
                                <strong>
                                    Inscripciones públicas
                                </strong>

                                <p id="registration-switch-description">
                                    @if($inscripcionesActivas)
                                        El formulario público está disponible
                                        y permite registrar asistentes.
                                    @else
                                        El formulario público está temporalmente
                                        deshabilitado.
                                    @endif
                                </p>

                                <span
                                    class="configuration-live-status
                                    {{ $inscripcionesActivas
                                        ? 'live-status-enabled'
                                        : 'live-status-disabled' }}"
                                    id="registration-live-status"
                                >
                                    <i></i>

                                    <span id="registration-status-text">
                                        {{ $inscripcionesActivas
                                            ? 'Registro habilitado'
                                            : 'Registro deshabilitado' }}
                                    </span>
                                </span>
                            </div>

                        </div>

                        <label class="switch configuration-switch">

                            <input
                                type="checkbox"
                                name="inscripciones_habilitadas"
                                value="1"
                                id="inscripciones_habilitadas"
                                @checked($inscripcionesActivas)
                            >

                            <span class="switch-slider"></span>

                        </label>

                    </div>

                    <div class="configuration-warning">

                        <div class="configuration-warning-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path d="M12 3L2.5 20h19z"/>
                                <path d="M12 9v5M12 17h.01"/>
                            </svg>
                        </div>

                        <div>
                            <strong>
                                Importante
                            </strong>

                            <p>
                                Deshabilitar esta opción no elimina las
                                inscripciones existentes. Únicamente impide
                                que se registren nuevas personas desde el
                                sitio público.
                            </p>
                        </div>

                    </div>

                </div>

            </section>

        </div>

        <aside class="configuration-sidebar">

            <section class="configuration-side-card configuration-preview-card">

                <div class="configuration-side-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8h.01M11 12h1v4h1"/>
                    </svg>
                </div>

                <h3>Antes de guardar</h3>

                <p>
                    Revisa cuidadosamente los datos que se mostrarán
                    o utilizarán dentro del sistema.
                </p>

                <ul>
                    <li>Comprueba el correo de contacto.</li>
                    <li>Verifica el teléfono y la dirección.</li>
                    <li>Revisa la redacción de los mensajes.</li>
                    <li>Confirma el estado de las inscripciones.</li>
                </ul>

            </section>

            <section class="configuration-side-card configuration-update-card">

                <span class="configuration-side-label">
                    Última actualización
                </span>

                <div class="configuration-update-date">

                    <div class="configuration-update-icon">
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
                        <strong>
                            {{ $ultimaActualizacion
                                ? \Carbon\Carbon::parse(
                                    $ultimaActualizacion
                                )->format('d/m/Y')
                                : 'Sin actualizar' }}
                        </strong>

                        <span>
                            {{ $ultimaActualizacion
                                ? \Carbon\Carbon::parse(
                                    $ultimaActualizacion
                                )->format('H:i') . ' h'
                                : 'No disponible' }}
                        </span>
                    </div>

                </div>

                <p>
                    Los cambios se aplicarán al guardar
                    esta configuración.
                </p>

            </section>

        </aside>

    </div>

    <div class="configuration-footer">

        <div class="configuration-footer-information">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 8h.01M11 12h1v4h1"/>
            </svg>

            <span>
                Revisa los cambios antes de actualizar la configuración.
            </span>

        </div>

        <button
            type="submit"
            class="btn btn-primary configuration-save-button"
        >
            <svg
                class="btn-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M5 4h12l2 2v14H5z"/>
                <path d="M8 4v6h8V4M8 20v-6h8v6"/>
            </svg>

            Guardar configuración
        </button>

    </div>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmationMessage = document.getElementById(
            'mensaje_confirmacion'
        );

        const reminderMessage = document.getElementById(
            'mensaje_recordatorio'
        );

        const confirmationCounter = document.getElementById(
            'confirmation-counter'
        );

        const reminderCounter = document.getElementById(
            'reminder-counter'
        );

        const registrationSwitch = document.getElementById(
            'inscripciones_habilitadas'
        );

        const registrationCard = document.getElementById(
            'registration-switch-card'
        );

        const registrationLiveStatus = document.getElementById(
            'registration-live-status'
        );

        const registrationStatusText = document.getElementById(
            'registration-status-text'
        );

        const registrationDescription = document.getElementById(
            'registration-switch-description'
        );

        function updateCharacterCounter(textarea, counter) {
            if (!textarea || !counter) {
                return;
            }

            counter.textContent =
                textarea.value.length + ' / 1000';
        }

        function updateRegistrationStatus() {
            if (!registrationSwitch) {
                return;
            }

            const enabled = registrationSwitch.checked;

            registrationCard.classList.toggle(
                'configuration-switch-enabled',
                enabled
            );

            registrationCard.classList.toggle(
                'configuration-switch-disabled',
                !enabled
            );

            registrationLiveStatus.classList.toggle(
                'live-status-enabled',
                enabled
            );

            registrationLiveStatus.classList.toggle(
                'live-status-disabled',
                !enabled
            );

            registrationStatusText.textContent = enabled
                ? 'Registro habilitado'
                : 'Registro deshabilitado';

            registrationDescription.textContent = enabled
                ? 'El formulario público está disponible y permite registrar asistentes.'
                : 'El formulario público está temporalmente deshabilitado.';
        }

        updateCharacterCounter(
            confirmationMessage,
            confirmationCounter
        );

        updateCharacterCounter(
            reminderMessage,
            reminderCounter
        );

        updateRegistrationStatus();

        confirmationMessage?.addEventListener('input', function () {
            updateCharacterCounter(
                confirmationMessage,
                confirmationCounter
            );
        });

        reminderMessage?.addEventListener('input', function () {
            updateCharacterCounter(
                reminderMessage,
                reminderCounter
            );
        });

        registrationSwitch?.addEventListener(
            'change',
            updateRegistrationStatus
        );
    });
</script>

@endsection