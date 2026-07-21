@extends('layouts.admin')

@section('title', 'Nuevo Docente | SGE')

@section('page-title', 'Nuevo Docente')

@section('content')

<div class="page-heading">
    <div>
        <h1>Registrar nuevo docente</h1>

        <p>
            Captura la información del docente que impartirá cursos
            o talleres en el Jardín Filosófico.
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
        action="{{ route('docentes.store') }}"
        method="POST"
        class="admin-form"
    >
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label for="nombre">Nombre completo</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico</label>

                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="{{ old('correo') }}"
                    required
                >
            </div>

            <div class="form-group form-group-full">
                <label for="bio">Biografía</label>

                <textarea
                    id="bio"
                    name="bio"
                    rows="6"
                    placeholder="Describe brevemente la experiencia o perfil del docente."
                >{{ old('bio') }}</textarea>
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
                Guardar docente
            </button>
        </div>

    </form>

</section>

@endsection