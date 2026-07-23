@extends('layouts.admin')

@section('title', 'Nueva Programación | SGE')
@section('page-title', 'Nueva Programación')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Nueva sesión
        </span>

        <h1>Registrar nueva programación</h1>

        <p>
            Selecciona el curso y captura la fecha y el horario
            correspondientes.
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

        <div class="form-card-header schedule-form-header">

            <div class="form-header-icon form-header-orange">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <path d="M16 3v4M8 3v4M3 10h18"/>
                    <path d="M12 14v4M10 16h4"/>
                </svg>
            </div>

            <div>
                <span>Información de la sesión</span>

                <h3>Curso, fecha y horario</h3>

                <p>
                    La sesión debe encontrarse dentro del periodo
                    establecido para el curso.
                </p>
            </div>

        </div>

        <form
            action="{{ route('programaciones.store') }}"
            method="POST"
            class="admin-form"
        >
            @csrf

            <div class="form-section">

                <div class="form-section-title">

                    <span class="form-section-number form-section-orange">
                        1
                    </span>

                    <div>
                        <strong>Selección del curso</strong>

                        <p>
                            Elige el curso al que pertenecerá esta sesión.
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
                                @endphp

                                <option
                                    value="{{ $curso->id_curso }}"
                                    @selected(
                                        old('id_curso') ==
                                        $curso->id_curso
                                    )
                                    @disabled($completo)
                                >
                                    {{ $curso->nombre }}
                                    —
                                    {{ $curso->programaciones_count }}
                                    de
                                    {{ $duracion }}
                                    sesiones

                                    @if($completo)
                                        — Cupo de sesiones completo
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        <small class="field-help">
                            Los cursos que ya alcanzaron su número de
                            sesiones aparecen deshabilitados.
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
                            Indica el día en que se impartirá la sesión.
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
                                value="{{ old('fecha') }}"
                                required
                            >
                        </div>

                        <small class="field-help">
                            La fecha debe encontrarse entre la fecha de
                            inicio y la fecha de fin del curso.
                        </small>

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
                            Registra la hora de inicio y finalización.
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
                                value="{{ old('hora_inicio') }}"
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
                                value="{{ old('hora_fin') }}"
                                required
                            >
                        </div>

                        <small class="field-help">
                            La hora de fin debe ser posterior a la hora
                            de inicio.
                        </small>

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

                    Guardar programación
                </button>

            </div>

        </form>

    </section>

    <aside class="form-help-card schedule-help-card">

        <div class="help-card-decoration"></div>

        <div class="help-card-icon">
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

        <h3>Programación de sesiones</h3>

        <p>
            Cada registro representa una sesión individual del curso
            seleccionado.
        </p>

        <ul>
            <li>Selecciona el curso correcto.</li>
            <li>Respeta su periodo de inicio y fin.</li>
            <li>Evita registrar horarios duplicados.</li>
            <li>Comprueba que la hora final sea posterior.</li>
        </ul>

    </aside>

</div>

@endsection