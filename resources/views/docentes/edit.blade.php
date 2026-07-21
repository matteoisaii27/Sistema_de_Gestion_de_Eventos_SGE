@extends('layouts.admin')

@section('title', 'Editar Docente | SGE')

@section('page-title', 'Editar Docente')

@section('content')

<div class="page-heading">
    <div>
        <h1>Editar docente</h1>

        <p>
            Actualiza la información del docente seleccionado.
        </p>
    </div>

    <a
        href="{{ route('docentes.index') }}"
        class="btn btn-secondary"
    >
        Volver
    </a>
</div>

<section class="card form-card">

    <form
        action="{{ route('docentes.update', $docente) }}"
        method="POST"
        class="admin-form"
    >
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label for="nombre">Nombre completo</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $docente->nombre) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico</label>

                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="{{ old('correo', $docente->correo) }}"
                    required
                >
            </div>

            <div class="form-group form-group-full">
                <label for="bio">Biografía</label>

                <textarea
                    id="bio"
                    name="bio"
                    rows="6"
                >{{ old('bio', $docente->bio) }}</textarea>
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
                Guardar cambios
            </button>
        </div>

    </form>

</section>

@endsection