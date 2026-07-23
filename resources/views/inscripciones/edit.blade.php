@extends('layouts.admin')

@section('title', 'Editar Inscripción | SGE')
@section('page-title', 'Editar Inscripción')

@section('content')

@php
    $nombreAsistente = $inscripcion->asistente->nombre;

    $partesNombre = preg_split(
        '/\s+/',
        trim($nombreAsistente)
    );

    $iniciales = collect($partesNombre)
        ->filter()
        ->take(2)
        ->map(
            fn ($parte) =>
                strtoupper(
                    mb_substr($parte, 0, 1)
                )
        )
        ->implode('');
@endphp

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Actualización de registro
        </span>

        <h1>Editar inscripción</h1>

        <p>
            Actualiza los datos del asistente, el curso
            o el estado de la inscripción.
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

        <div class="form-card-header enrollment-edit-header">

            <div class="enrollment-large-avatar">
                {{ $iniciales }}
            </div>

            <div>
                <span>
                    Inscripción #{{ $inscripcion->id_inscripcion }}
                </span>

                <h3>{{ $nombreAsistente }}</h3>

                <p>
                    {{ $inscripcion->curso->nombre }}
                </p>
            </div>

        </div>

        <form
            action="{{ route(
                'inscripciones.update',
                $inscripcion
            ) }}"
            method="POST"
            class="admin-form"
        >
            @csrf
            @method('PUT')

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number form-section-purple">
                        1
                    </span>

                    <div>
                        <strong>Información personal</strong>

                        <p>
                            Actualiza los datos del asistente.
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
                                maxlength="150"
                                value="{{ old(
                                    'nombre',
                                    $inscripcion->asistente->nombre
                                ) }}"
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
                                maxlength="150"
                                value="{{ old(
                                    'correo',
                                    $inscripcion->asistente->correo
                                ) }}"
                                required
                            >
                        </div>

                        <small class="field-help">
                            El correo no debe pertenecer a otro asistente.
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
                                maxlength="20"
                                value="{{ old(
                                    'telefono',
                                    $inscripcion->asistente->telefono
                                ) }}"
                            >
                        </div>

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
                            Conserva el curso actual o selecciona otro.
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
                                        old(
                                            'id_curso',
                                            $inscripcion->id_curso
                                        ) == $curso->id_curso
                                    )
                                >
                                    {{ $curso->nombre }}

                                    @if(
                                        $curso->id_curso ==
                                        $inscripcion->id_curso
                                    )
                                        — Curso actual
                                    @endif
                                </option>

                            @endforeach
                        </select>

                        <small class="field-help">
                            No es posible seleccionar un curso en el que
                            este asistente ya tenga otra inscripción.
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
                            Actualiza la situación actual del registro.
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
                                        $inscripcion->estado
                                    ) === 'confirmada'
                                )
                            >
                                Confirmada
                            </option>

                            <option
                                value="pendiente"
                                @selected(
                                    old(
                                        'estado',
                                        $inscripcion->estado
                                    ) === 'pendiente'
                                )
                            >
                                Pendiente
                            </option>

                            <option
                                value="cancelada"
                                @selected(
                                    old(
                                        'estado',
                                        $inscripcion->estado
                                    ) === 'cancelada'
                                )
                            >
                                Cancelada
                            </option>
                        </select>

                        <div class="enrollment-state-guide">

                            <span class="guide-confirmed">
                                <i></i>
                                Confirmada
                            </span>

                            <span class="guide-pending">
                                <i></i>
                                Pendiente
                            </span>

                            <span class="guide-cancelled">
                                <i></i>
                                Cancelada
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

                    Guardar cambios
                </button>

            </div>

        </form>

    </section>

    <aside class="form-help-card enrollment-help-card enrollment-edit-help">

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
            Revisa la información original antes de realizar cambios.
        </p>

        <div class="enrollment-edit-summary">

            <div>
                <span>ID</span>
                <strong>
                    #{{ $inscripcion->id_inscripcion }}
                </strong>
            </div>

            <div>
                <span>Correo</span>
                <strong>
                    {{ $inscripcion->asistente->correo }}
                </strong>
            </div>

            <div>
                <span>Curso</span>
                <strong>
                    {{ $inscripcion->curso->nombre }}
                </strong>
            </div>

            <div>
                <span>Estado</span>
                <strong>
                    {{ ucfirst($inscripcion->estado) }}
                </strong>
            </div>

            <div>
                <span>Registro</span>
                <strong>
                    {{ \Carbon\Carbon::parse(
                        $inscripcion->fecha_registro
                    )->format('d/m/Y H:i') }}
                </strong>
            </div>

        </div>

    </aside>

</div>

@endsection