@extends('layouts.admin')

@section('title', 'Editar Docente | SGE')
@section('page-title', 'Editar Docente')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Actualización de perfil
        </span>

        <h1>Editar docente</h1>

        <p>
            Actualiza la información de
            <strong>{{ $docente->nombre }}</strong>.
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

        <div class="form-card-header teacher-edit-header">

            <div class="teacher-large-avatar">
                {{ strtoupper(substr($docente->nombre, 0, 1)) }}
            </div>

            <div>
                <span>Docente #{{ $docente->id_docente }}</span>

                <h3>{{ $docente->nombre }}</h3>

                <p>
                    Modifica únicamente los datos que necesiten actualizarse.
                </p>
            </div>

        </div>

        <form
            action="{{ route('docentes.update', $docente) }}"
            method="POST"
            class="admin-form"
        >
            @csrf
            @method('PUT')

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number teacher-section-number">
                        1
                    </span>

                    <div>
                        <strong>Información de contacto</strong>

                        <p>
                            Actualiza el nombre o el correo electrónico.
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
                                value="{{ old('nombre', $docente->nombre) }}"
                                maxlength="150"
                                required
                            >
                        </div>

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
                                value="{{ old('correo', $docente->correo) }}"
                                maxlength="150"
                                required
                            >
                        </div>

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
                            Actualiza la biografía o experiencia del docente.
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
                            placeholder="Describe brevemente su formación, experiencia o especialidades..."
                        >{{ old('bio', $docente->bio) }}</textarea>

                        <small class="field-help">
                            Este campo puede dejarse vacío cuando todavía
                            no se cuenta con la información.
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

                    Guardar cambios
                </button>

            </div>

        </form>

    </section>

    <aside class="form-help-card teacher-help-card teacher-edit-help">

        <div class="help-card-decoration"></div>

        <div class="help-card-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M12 20h9"/>
                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4z"/>
            </svg>
        </div>

        <h3>Datos actuales</h3>

        <p>
            Revisa los datos antes de guardar para evitar información
            incompleta o correos incorrectos.
        </p>

        <div class="teacher-edit-summary">

            <div>
                <span>ID del docente</span>
                <strong>#{{ $docente->id_docente }}</strong>
            </div>

            <div>
                <span>Correo actual</span>
                <strong>{{ $docente->correo }}</strong>
            </div>

            <div>
                <span>Biografía</span>
                <strong>
                    {{ $docente->bio ? 'Registrada' : 'Sin registrar' }}
                </strong>
            </div>

        </div>

    </aside>

</div>

@endsection