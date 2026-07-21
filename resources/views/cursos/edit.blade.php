@extends('layouts.admin')

@section('title', 'Editar Curso | SGE')

@section('page-title', 'Editar Curso')

@section('content')

<div class="page-heading">
    <div>
        <h1>Editar curso</h1>

        <p>
            Actualiza la información del curso seleccionado.
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
        action="{{ route('cursos.update', $curso) }}"
        method="POST"
        class="admin-form"
    >
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group form-group-full">
                <label for="nombre">Nombre del curso</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $curso->nombre) }}"
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
                >{{ old('descripcion', $curso->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label for="duracion">Duración</label>

                <input
                    type="text"
                    id="duracion"
                    name="duracion"
                    value="{{ old('duracion', $curso->duracion) }}"
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
                    value="{{ old('cupo_maximo', $curso->cupo_maximo) }}"
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
            </div>

            <div class="form-group"></div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio</label>

                <input
                    type="date"
                    id="fecha_inicio"
                    name="fecha_inicio"
                    value="{{ old('fecha_inicio', $curso->fecha_inicio) }}"
                >
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de fin</label>

                <input
                    type="date"
                    id="fecha_fin"
                    name="fecha_fin"
                    value="{{ old('fecha_fin', $curso->fecha_fin) }}"
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
                Guardar cambios
            </button>
        </div>

    </form>

</section>

@endsection