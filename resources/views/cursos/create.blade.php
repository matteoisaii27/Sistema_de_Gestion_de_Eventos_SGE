@extends('layouts.admin')

@section('title', 'Nuevo Curso | SGE')

@section('page-title', 'Nuevo Curso')

@section('content')

<div class="page-heading">
    <div>
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
        Volver
    </a>
</div>

<section class="card form-card">

    <form
        action="{{ route('cursos.store') }}"
        method="POST"
        class="admin-form"
    >
        @csrf

        <div class="form-grid">

            <div class="form-group form-group-full">
                <label for="nombre">Nombre del curso</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                >
            </div>

            <div class="form-group form-group-full">
                <label for="descripcion">Descripción</label>

                <textarea
                    id="descripcion"
                    name="descripcion"
                    rows="5"
                    required
                >{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group">
                <label for="duracion">Duración</label>

                <input
                    type="text"
                    id="duracion"
                    name="duracion"
                    value="{{ old('duracion') }}"
                    placeholder="Ejemplo: 4 sesiones"
                    required
                >
            </div>

            <div class="form-group">
                <label for="cupo_maximo">Cupo máximo</label>

                <input
                    type="number"
                    id="cupo_maximo"
                    name="cupo_maximo"
                    value="{{ old('cupo_maximo') }}"
                    min="1"
                    required
                >
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>

                <select
                    id="estado"
                    name="estado"
                    required
                >
                    <option
                        value="activo"
                        @selected(old('estado') === 'activo')
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
            </div>

            <div class="form-group"></div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio</label>

                <input
                    type="date"
                    id="fecha_inicio"
                    name="fecha_inicio"
                    value="{{ old('fecha_inicio') }}"
                >
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de fin</label>

                <input
                    type="date"
                    id="fecha_fin"
                    name="fecha_fin"
                    value="{{ old('fecha_fin') }}"
                >
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
                Guardar curso
            </button>
        </div>

    </form>

</section>

@endsection