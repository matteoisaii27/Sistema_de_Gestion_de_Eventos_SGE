@extends('layouts.admin')

@section('title', 'Editar Programación | SGE')
@section('page-title', 'Editar Programación')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Actualización de sesión
        </span>

        <h1>Editar programación</h1>

        <p>
            Actualiza el curso, la fecha o el horario
            de la sesión seleccionada.
        </p>
    </div>

    <a
        href="{{ route('programaciones.index') }}"
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

<div class="form-layout schedule-form-layout">

    <section class="card form-card">

        <div class="form-card-header schedule-edit-header">

            <div class="schedule-edit-date">

                <span>
                    {{ strtoupper(
                        \Carbon\Carbon::parse($programacion->fecha)
                            ->locale('es')
                            ->translatedFormat('M')
                    ) }}
                </span>

                <strong>
                    {{ \Carbon\Carbon::parse($programacion->fecha)->format('d') }}
                </strong>

            </div>

            <div>
                <span>
                    Programación #{{ $programacion->id_programacion }}
                </span>

                <h3>
                    {{ $programacion->curso->nombre }}
                </h3>

                <p>
                    {{ \Carbon\Carbon::parse(
                        $programacion->hora_inicio
                    )->format('H:i') }}

                    a

                    {{ \Carbon\Carbon::parse(
                        $programacion->hora_fin
                    )->format('H:i') }}
                </p>
            </div>

        </div>

        <form
            action="{{ route(
                'programaciones.update',
                $programacion
            ) }}"
            method="POST"
            class="admin-form"
        >
            @csrf
            @method('PUT')

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number form-section-orange">
                        1
                    </span>

                    <div>
                        <strong>Curso asignado</strong>

                        <p>
                            Puedes conservar el curso actual o seleccionar otro.
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

                                @php
                                    $duracion = (int) filter_var(
                                        $curso->duracion,
                                        FILTER_SANITIZE_NUMBER_INT
                                    );

                                    $completo =
                                        $curso->programaciones_count >=
                                        $duracion;

                                    $esActual =
                                        $curso->id_curso ==
                                        $programacion->id_curso;
                                @endphp

                                <option
                                    value="{{ $curso->id_curso }}"
                                    @selected(
                                        old(
                                            'id_curso',
                                            $programacion->id_curso
                                        ) == $curso->id_curso
                                    )
                                    @disabled($completo && !$esActual)
                                >
                                    {{ $curso->nombre }}
                                    —
                                    {{ $curso->programaciones_count }}
                                    de
                                    {{ $duracion }}
                                    sesiones

                                    @if($completo && !$esActual)
                                        — Cupo de sesiones completo
                                    @elseif($esActual)
                                        — Curso actual
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        <small class="field-help">
                            El curso actual puede conservarse aunque ya
                            tenga todas sus sesiones programadas.
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

                    <span class="form-section-number">
                        2
                    </span>

                    <div>
                        <strong>Fecha de la sesión</strong>

                        <p>
                            Actualiza el día en que se impartirá.
                        </p>
                    </div>

                </div>

                <div class="form-grid">

                    <div class="form-group form-group-full">
                        <label for="fecha">
                            Fecha
                            <span class="required-mark">*</span>
                        </label>

                        <div class="input-with-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <rect x="3" y="5" width="18" height="16" rx="2"/>
                                <path d="M16 3v4M8 3v4M3 10h18"/>
                            </svg>

                            <input
                                type="date"
                                id="fecha"
                                name="fecha"
                                value="{{ old(
                                    'fecha',
                                    $programacion->fecha
                                ) }}"
                                required
                            >
                        </div>

                        @error('fecha')
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
                        3
                    </span>

                    <div>
                        <strong>Horario</strong>

                        <p>
                            Actualiza la hora de inicio o finalización.
                        </p>
                    </div>

                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="hora_inicio">
                            Hora de inicio
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
                                type="time"
                                id="hora_inicio"
                                name="hora_inicio"
                                value="{{ old(
                                    'hora_inicio',
                                    substr(
                                        $programacion->hora_inicio,
                                        0,
                                        5
                                    )
                                ) }}"
                                required
                            >
                        </div>

                        @error('hora_inicio')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hora_fin">
                            Hora de fin
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
                                type="time"
                                id="hora_fin"
                                name="hora_fin"
                                value="{{ old(
                                    'hora_fin',
                                    substr(
                                        $programacion->hora_fin,
                                        0,
                                        5
                                    )
                                ) }}"
                                required
                            >
                        </div>

                        @error('hora_fin')
                            <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form-actions">

                <a
                    href="{{ route('programaciones.index') }}"
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

    <aside class="form-help-card schedule-help-card schedule-edit-help">

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
            Comprueba que la sesión continúe dentro del periodo
            correspondiente al curso.
        </p>

        <div class="schedule-edit-summary">

            <div>
                <span>ID</span>
                <strong>
                    #{{ $programacion->id_programacion }}
                </strong>
            </div>

            <div>
                <span>Curso</span>
                <strong>
                    {{ $programacion->curso->nombre }}
                </strong>
            </div>

            <div>
                <span>Fecha</span>
                <strong>
                    {{ \Carbon\Carbon::parse(
                        $programacion->fecha
                    )->format('d/m/Y') }}
                </strong>
            </div>

            <div>
                <span>Horario</span>
                <strong>
                    {{ \Carbon\Carbon::parse(
                        $programacion->hora_inicio
                    )->format('H:i') }}

                    –

                    {{ \Carbon\Carbon::parse(
                        $programacion->hora_fin
                    )->format('H:i') }}
                </strong>
            </div>

        </div>

    </aside>

</div>

@endsection