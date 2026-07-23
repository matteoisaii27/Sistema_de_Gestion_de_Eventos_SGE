@extends('layouts.admin')

@section('title', 'Nueva Inscripción | SGE')
@section('page-title', 'Nueva Inscripción')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Registro administrativo
        </span>

        <h1>Registrar nueva inscripción</h1>

        <p>
            Captura los datos del asistente y selecciona el curso
            al que desea inscribirse.
        </p>
    </div>

    <a
        href="{{ route('inscripciones.index') }}"
        class="btn btn-secondary"
    >
        <svg
            class="btn-icon"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path d="M19 12H5"/>
            <path d="M12 19l-7-7 7-7"/>
        </svg>

        Volver
    </a>

</div>

<div class="form-layout enrollment-form-layout">

    <section class="card form-card">

        <div class="form-card-header enrollment-form-header">

            <div class="form-header-icon form-header-purple">
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
                <span>Nueva inscripción</span>

                <h3>Datos del participante</h3>

                <p>
                    La información se utilizará para identificar
                    y contactar al asistente.
                </p>
            </div>

        </div>

        <form
            action="{{ route('inscripciones.store') }}"
            method="POST"
            class="admin-form"
        >
            @csrf

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number form-section-purple">
                        1
                    </span>

                    <div>
                        <strong>Información personal</strong>

                        <p>
                            Registra el nombre y los datos de contacto.
                        </p>
                    </div>

                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="nombre">
                            Nombre completo
                            <span class="required-mark">*</span>
                        </label>

                        <div class="input-with-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4.5 21a7.5 7.5 0 0 1 15 0"/>
                            </svg>

                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                maxlength="150"
                                placeholder="Ejemplo: Andrea Pérez Gómez"
                                required
                            >
                        </div>

                        <small class="field-help">
                            Escribe el nombre completo del participante.
                        </small>

                        @error('nombre')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="correo">
                            Correo electrónico
                            <span class="required-mark">*</span>
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
                                id="correo"
                                name="correo"
                                value="{{ old('correo') }}"
                                maxlength="150"
                                placeholder="participante@correo.com"
                                required
                            >
                        </div>

                        <small class="field-help">
                            Este correo identifica al asistente en el sistema.
                        </small>

                        @error('correo')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-full">
                        <label for="telefono">
                            Teléfono
                            <span class="optional-label">(opcional)</span>
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
                                id="telefono"
                                name="telefono"
                                value="{{ old('telefono') }}"
                                maxlength="20"
                                placeholder="Ejemplo: 998 123 4567"
                            >
                        </div>

                        <small class="field-help">
                            Puede utilizarse como medio de contacto alternativo.
                        </small>

                        @error('telefono')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number">
                        2
                    </span>

                    <div>
                        <strong>Curso seleccionado</strong>

                        <p>
                            Indica el curso al que se inscribirá el asistente.
                        </p>
                    </div>

                </div>

                <div class="form-grid">

                    <div class="form-group form-group-full">
                        <label for="id_curso">
                            Curso
                            <span class="required-mark">*</span>
                        </label>

                        <select
                            id="id_curso"
                            name="id_curso"
                            required
                        >
                            <option value="">
                                Selecciona un curso
                            </option>

                            @foreach($cursos as $curso)

                                <option
                                    value="{{ $curso->id_curso }}"
                                    @selected(
                                        old('id_curso') ==
                                        $curso->id_curso
                                    )
                                >
                                    {{ $curso->nombre }}
                                </option>

                            @endforeach
                        </select>

                        <small class="field-help">
                            Un asistente no puede inscribirse dos veces
                            en el mismo curso.
                        </small>

                        @error('id_curso')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number form-section-orange">
                        3
                    </span>

                    <div>
                        <strong>Estado de la inscripción</strong>

                        <p>
                            Define la situación actual del registro.
                        </p>
                    </div>

                </div>

                <div class="form-grid">

                    <div class="form-group form-group-full">
                        <label for="estado">
                            Estado
                            <span class="required-mark">*</span>
                        </label>

                        <select
                            id="estado"
                            name="estado"
                            required
                        >
                            <option
                                value="confirmada"
                                @selected(
                                    old(
                                        'estado',
                                        'confirmada'
                                    ) === 'confirmada'
                                )
                            >
                                Confirmada
                            </option>

                            <option
                                value="pendiente"
                                @selected(
                                    old('estado') === 'pendiente'
                                )
                            >
                                Pendiente
                            </option>

                            <option
                                value="cancelada"
                                @selected(
                                    old('estado') === 'cancelada'
                                )
                            >
                                Cancelada
                            </option>
                        </select>

                        <div class="enrollment-state-guide">

                            <span class="guide-confirmed">
                                <i></i>
                                Confirmada: inscripción válida
                            </span>

                            <span class="guide-pending">
                                <i></i>
                                Pendiente: requiere seguimiento
                            </span>

                            <span class="guide-cancelled">
                                <i></i>
                                Cancelada: registro sin vigencia
                            </span>

                        </div>

                        @error('estado')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-actions">

                <a
                    href="{{ route('inscripciones.index') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <svg
                        class="btn-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>

                    Guardar inscripción
                </button>

            </div>

        </form>

    </section>

    <aside class="form-help-card enrollment-help-card">

        <div class="help-card-decoration"></div>

        <div class="help-card-icon">
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

        <h3>Registro del participante</h3>

        <p>
            Antes de guardar, comprueba que los datos correspondan
            a la persona y al curso seleccionado.
        </p>

        <ul>
            <li>Verifica la escritura del nombre.</li>
            <li>Utiliza un correo válido y accesible.</li>
            <li>Selecciona el curso correcto.</li>
            <li>Evita duplicar inscripciones.</li>
            <li>Asigna el estado correspondiente.</li>
        </ul>

    </aside>

</div>

@endsection