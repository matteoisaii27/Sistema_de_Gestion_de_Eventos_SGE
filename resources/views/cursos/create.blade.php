@extends('layouts.admin')

@section('title', 'Nuevo Curso | SGE')
@section('page-title', 'Nuevo Curso')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Nuevo registro
        </span>

        <h1>Registrar nuevo curso</h1>

        <p>
            Captura la información general del curso o taller que
            estará disponible en el Jardín Filosófico.
        </p>
    </div>

    <a
        href="{{ route('cursos.index') }}"
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

<div class="form-layout">

    <section class="card form-card">

        <div class="form-card-header">

            <div class="form-header-icon form-header-green">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                    <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
                </svg>
            </div>

            <div>
                <span>Información del curso</span>
                <h3>Datos generales</h3>
                <p>
                    Los campos marcados con asterisco son obligatorios.
                </p>
            </div>

        </div>

        <form
            action="{{ route('cursos.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="admin-form"
        >
            @csrf

            <div class="form-section">

                <div class="form-section-title">
                    <span class="form-section-number">1</span>

                    <div>
                        <strong>Información principal</strong>
                        <p>Nombre y descripción pública del curso.</p>
                    </div>
                </div>

                <div class="form-grid">

                    <div class="form-group form-group-full">
                        <label for="nombre">
                            Nombre del curso
                            <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Ejemplo: Taller de huertos urbanos"
                            maxlength="150"
                            required
                        >

                        <small class="field-help">
                            Utiliza un nombre claro y fácil de identificar.
                        </small>

                        @error('nombre')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-full">
                        <label for="descripcion">
                            Descripción
                            <span class="required-mark">*</span>
                        </label>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            rows="5"
                            placeholder="Describe el contenido, propósito y público del curso..."
                            required
                        >{{ old('descripcion') }}</textarea>

                        <small class="field-help">
                            Esta información podrá mostrarse en el sitio público.
                        </small>

                        @error('descripcion')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-title">
                    <span class="form-section-number form-section-green">
                        2
                    </span>

                    <div>
                        <strong>Imagen del curso</strong>

                        <p>
                            Esta fotografía se mostrará en el sitio público.
                        </p>
                    </div>
                </div>

                <div class="form-grid">

                    <div class="form-group form-group-full">

                        <label for="imagen">
                            Fotografía

                            <span class="optional-label">
                                (opcional)
                            </span>
                        </label>

                        <input
                            type="file"
                            id="imagen"
                            name="imagen"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <small class="field-help">
                            Formatos permitidos: JPG, PNG y WEBP.
                            Tamaño máximo: 2 MB.
                        </small>

                        @error('imagen')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-title">
                    <span class="form-section-number form-section-orange">3</span>

                    <div>
                        <strong>Capacidad y disponibilidad</strong>
                        <p>Define la duración, el cupo y el estado del curso.</p>
                    </div>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="duracion">
                            Duración
                            <span class="required-mark">*</span>
                        </label>

                        <div class="input-with-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>

                            <input
                                type="text"
                                id="duracion"
                                name="duracion"
                                value="{{ old('duracion') }}"
                                placeholder="Ejemplo: 4 sesiones"
                                maxlength="100"
                                required
                            >
                        </div>

                        @error('duracion')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cupo_maximo">
                            Cupo máximo
                            <span class="required-mark">*</span>
                        </label>

                        <div class="input-with-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <circle cx="9" cy="8" r="3"/>
                                <path d="M3.5 20a5.5 5.5 0 0 1 11 0"/>
                                <path d="M16 11a3 3 0 0 0 0-6"/>
                            </svg>

                            <input
                                type="number"
                                id="cupo_maximo"
                                name="cupo_maximo"
                                value="{{ old('cupo_maximo') }}"
                                min="1"
                                placeholder="Ejemplo: 25"
                                required
                            >
                        </div>

                        @error('cupo_maximo')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
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
                                value="activo"
                                @selected(old('estado', 'activo') === 'activo')
                            >
                                Activo
                            </option>

                            <option
                                value="inactivo"
                                @selected(old('estado') === 'inactivo')
                            >
                                Inactivo
                            </option>
                        </select>

                        <small class="field-help">
                            Los cursos activos pueden aparecer en el sitio público.
                        </small>

                        @error('estado')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-title">
                    <span class="form-section-number form-section-purple">4</span>

                    <div>
                        <strong>Periodo del curso</strong>
                        <p>Indica las fechas generales de inicio y finalización.</p>
                    </div>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="fecha_inicio">
                            Fecha de inicio
                            <span class="optional-label">(opcional)</span>
                        </label>

                        <input
                            type="date"
                            id="fecha_inicio"
                            name="fecha_inicio"
                            value="{{ old('fecha_inicio') }}"
                        >

                        @error('fecha_inicio')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin">
                            Fecha de fin
                            <span class="optional-label">(opcional)</span>
                        </label>

                        <input
                            type="date"
                            id="fecha_fin"
                            name="fecha_fin"
                            value="{{ old('fecha_fin') }}"
                        >

                        @error('fecha_fin')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-actions">

                <a
                    href="{{ route('cursos.index') }}"
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

                    Guardar curso
                </button>

            </div>

        </form>

    </section>

    <aside class="form-help-card">

        <div class="help-card-decoration"></div>

        <div class="help-card-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 16v-4"/>
                <path d="M12 8h.01"/>
            </svg>
        </div>

        <h3>Antes de registrar</h3>

        <p>
            Verifica que la información corresponda al curso que será
            publicado para los asistentes.
        </p>

        <ul>
            <li>Utiliza un nombre descriptivo.</li>
            <li>Define un cupo realista.</li>
            <li>Revisa el periodo del curso.</li>
            <li>Actívalo únicamente cuando esté listo.</li>
        </ul>

    </aside>

</div>

@endsection