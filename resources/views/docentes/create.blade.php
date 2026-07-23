@extends('layouts.admin')

@section('title', 'Nuevo Docente | SGE')
@section('page-title', 'Nuevo Docente')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Nuevo integrante
        </span>

        <h1>Registrar nuevo docente</h1>

        <p>
            Captura la información del docente que impartirá cursos
            o talleres en el Jardín Filosófico.
        </p>
    </div>

    <a
        href="{{ route('docentes.index') }}"
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

<div class="form-layout teacher-form-layout">

    <section class="card form-card">

        <div class="form-card-header teacher-form-header">

            <div class="form-header-icon form-header-turquoise">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4.5 21a7.5 7.5 0 0 1 15 0"/>
                    <path d="M19 5v6M16 8h6"/>
                </svg>
            </div>

            <div>
                <span>Información del docente</span>
                <h3>Datos personales y profesionales</h3>

                <p>
                    Registra los datos necesarios para identificar al docente.
                </p>
            </div>

        </div>

        <form
            action="{{ route('docentes.store') }}"
            method="POST"
            class="admin-form"
        >
            @csrf

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number teacher-section-number">
                        1
                    </span>

                    <div>
                        <strong>Información de contacto</strong>
                        <p>
                            Nombre completo y correo electrónico del docente.
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
                                placeholder="Ejemplo: María López Hernández"
                                maxlength="150"
                                required
                            >
                        </div>

                        <small class="field-help">
                            Escribe el nombre y los apellidos completos.
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
                                placeholder="docente@correo.com"
                                maxlength="150"
                                required
                            >
                        </div>

                        <small class="field-help">
                            El correo no puede estar registrado por otro docente.
                        </small>

                        @error('correo')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number form-section-purple">
                        2
                    </span>

                    <div>
                        <strong>Perfil profesional</strong>

                        <p>
                            Añade una breve descripción de la experiencia
                            del docente.
                        </p>
                    </div>

                </div>

                <div class="form-grid">

                    <div class="form-group form-group-full">
                        <label for="bio">
                            Biografía
                            <span class="optional-label">(opcional)</span>
                        </label>

                        <textarea
                            id="bio"
                            name="bio"
                            rows="7"
                            placeholder="Describe brevemente su formación, experiencia, especialidades o trayectoria profesional..."
                        >{{ old('bio') }}</textarea>

                        <small class="field-help">
                            Utiliza un texto breve, claro y relacionado con
                            los cursos que puede impartir.
                        </small>

                        @error('bio')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-actions">

                <a
                    href="{{ route('docentes.index') }}"
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

                    Guardar docente
                </button>

            </div>

        </form>

    </section>

    <aside class="form-help-card teacher-help-card">

        <div class="help-card-decoration"></div>

        <div class="help-card-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="12" cy="8" r="4"/>
                <path d="M4.5 21a7.5 7.5 0 0 1 15 0"/>
            </svg>
        </div>

        <h3>Perfil del docente</h3>

        <p>
            La información registrada permitirá relacionar al docente
            con los cursos y presentarlo adecuadamente en el sistema.
        </p>

        <ul>
            <li>Comprueba la escritura del nombre.</li>
            <li>Registra un correo electrónico válido.</li>
            <li>Evita repetir correos ya registrados.</li>
            <li>Resume la experiencia de manera profesional.</li>
        </ul>

    </aside>

</div>

@endsection