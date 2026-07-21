@extends('layouts.admin')

@section('title', 'Editar Programación | SGE')

@section('page-title', 'Editar Programación')

@section('content')

<div class="page-heading">
    <div>
        <h1>Editar programación</h1>

        <p>
            Actualiza el curso, la fecha o el horario
            de la programación seleccionada.
        </p>
    </div>

    <a
        href="{{ route('programaciones.index') }}"
        class="btn btn-secondary"
    >
        Volver
    </a>
</div>

<section class="card form-card">

    <form
        action="{{ route('programaciones.update', $programacion) }}"
        method="POST"
        class="admin-form"
    >
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group form-group-full">
                <label for="id_curso">Curso</label>

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
            $duracion = (int) filter_var($curso->duracion, FILTER_SANITIZE_NUMBER_INT);
            $completo = $curso->programaciones_count >= $duracion;
            $esActual = $curso->id_curso == $programacion->id_curso;
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

            @if($completo)
                🔒 ({{ $curso->programaciones_count }} de {{ $duracion }} sesiones)
            @else
                ({{ $curso->programaciones_count }} de {{ $duracion }} sesiones)
            @endif

        </option>

    @endforeach

</select>
            </div>

            <div class="form-group form-group-full">
                <label for="fecha">Fecha</label>

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

            <div class="form-group">
                <label for="hora_inicio">Hora de inicio</label>

                <input
                    type="time"
                    id="hora_inicio"
                    name="hora_inicio"
                    value="{{ old(
                        'hora_inicio',
                        substr($programacion->hora_inicio, 0, 5)
                    ) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="hora_fin">Hora de fin</label>

                <input
                    type="time"
                    id="hora_fin"
                    name="hora_fin"
                    value="{{ old(
                        'hora_fin',
                        substr($programacion->hora_fin, 0, 5)
                    ) }}"
                    required
                >
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
                Guardar cambios
            </button>
        </div>

    </form>

</section>

@endsection