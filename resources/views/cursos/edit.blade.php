@extends('layouts.admin')

@section('title', 'Editar Curso | SGE')
@section('page-title', 'Editar Curso')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Actualización de registro
        </span>

        <h1>Editar curso</h1>

        <p>
            Actualiza la información del curso
            <strong>{{ $curso->nombre }}</strong>.
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

            <div class="form-header-icon form-header-purple">
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

            <div>
                <span>Curso #{{ $curso->id_curso }}</span>
                <h3>{{ $curso->nombre }}</h3>
                <p>
                    Modifica únicamente la información que necesites actualizar.
                </p>
            </div>

            <span
                class="status
                {{ $curso->estado === 'activo'
                    ? 'status-active'
                    : 'status-inactive' }}"
            >
                {{ ucfirst($curso->estado) }}
            </span>

        </div>

        <form
            action="{{ route('cursos.update', $curso) }}"
            method="POST"
            enctype="multipart/form-data"
            class="admin-form"
        >
            @csrf
            @method('PUT')

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
                            value="{{ old('nombre', $curso->nombre) }}"
                            maxlength="150"
                            required
                        >

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
                            required
                        >{{ old('descripcion', $curso->descripcion) }}</textarea>

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
                    <span class="form-section-number form-section-green">2</span>

                    <div>
                        <strong>Imagen del curso</strong>
                        <p>
                            Consulta la fotografía actual o selecciona una nueva.
                        </p>
                    </div>
                </div>

                <div class="form-grid">

                    <div class="form-group form-group-full">

                        @if($curso->imagen)

                            <label>
                                Imagen actual
                            </label>

                            <div
                                style="
                                    width: 100%;
                                    max-width: 440px;
                                    margin-bottom: 18px;
                                    overflow: hidden;
                                    border: 1px solid #e5e7eb;
                                    border-radius: 16px;
                                    background: #f8fafc;
                                "
                            >
                                <img
                                    src="{{ asset('storage/' . $curso->imagen) }}"
                                    alt="Imagen del curso {{ $curso->nombre }}"
                                    style="
                                        display: block;
                                        width: 100%;
                                        height: 250px;
                                        object-fit: cover;
                                    "
                                >
                            </div>

                        @else

                            <div
                                style="
                                    width: 100%;
                                    max-width: 440px;
                                    margin-bottom: 18px;
                                    padding: 35px 20px;
                                    text-align: center;
                                    border: 1px dashed #cbd5e1;
                                    border-radius: 16px;
                                    background: #f8fafc;
                                    color: #64748b;
                                "
                            >
                                Este curso todavía no tiene una imagen registrada.
                            </div>

                        @endif

                        <label for="imagen">
                            {{ $curso->imagen
                                ? 'Reemplazar fotografía'
                                : 'Agregar fotografía' }}

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
                            Si no seleccionas una nueva fotografía, se conservará la actual.
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
                        <p>Actualiza la duración, el cupo o el estado.</p>
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
                                value="{{ old('duracion', $curso->duracion) }}"
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
                                value="{{ old('cupo_maximo', $curso->cupo_maximo) }}"
                                min="1"
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
                                @selected(old('estado', $curso->estado) === 'activo')
                            >
                                Activo
                            </option>

                            <option
                                value="inactivo"
                                @selected(old('estado', $curso->estado) === 'inactivo')
                            >
                                Inactivo
                            </option>
                        </select>

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
                        <p>Actualiza las fechas generales del curso.</p>
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
                            value="{{ old('fecha_inicio', $curso->fecha_inicio) }}"
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
                            value="{{ old('fecha_fin', $curso->fecha_fin) }}"
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

                    Guardar cambios
                </button>

            </div>

        </form>

    </section>

    <aside class="form-help-card edit-help-card">

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

        <h3>Edición del curso</h3>

        <p>
            Los cambios guardados se reflejarán en el panel y en las
            vistas públicas correspondientes.
        </p>

        <div class="course-edit-summary">

            <div>
                <span>ID del curso</span>
                <strong>#{{ $curso->id_curso }}</strong>
            </div>

            <div>
                <span>Estado actual</span>
                <strong>{{ ucfirst($curso->estado) }}</strong>
            </div>

            <div>
                <span>Cupo registrado</span>
                <strong>{{ $curso->cupo_maximo }} personas</strong>
            </div>

        </div>

    </aside>

</div>

@endsection