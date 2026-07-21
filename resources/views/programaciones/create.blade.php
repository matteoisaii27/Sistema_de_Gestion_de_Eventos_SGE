@extends('layouts.admin')

@section('title', 'Nueva Programación | SGE')

@section('page-title', 'Nueva Programación')

@section('content')

<div class="page-heading">
    <div>
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
        Volver
    </a>
</div>

<section class="card form-card">

    <form
        action="{{ route('programaciones.store') }}"
        method="POST"
        class="admin-form"
    >
        @csrf

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
                        <option
                            value="{{ $curso->id_curso }}"
                            @selected(
                                old('id_curso') == $curso->id_curso
                            )
                        >
                            {{ $curso->nombre }}
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
                    value="{{ old('fecha') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="hora_inicio">Hora de inicio</label>

                <input
                    type="time"
                    id="hora_inicio"
                    name="hora_inicio"
                    value="{{ old('hora_inicio') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="hora_fin">Hora de fin</label>

                <input
                    type="time"
                    id="hora_fin"
                    name="hora_fin"
                    value="{{ old('hora_fin') }}"
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
                Guardar programación
            </button>
        </div>

    </form>

</section>

@endsection