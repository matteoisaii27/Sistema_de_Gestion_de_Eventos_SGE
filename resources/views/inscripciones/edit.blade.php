@extends('layouts.admin')

@section('title', 'Editar Inscripción | SGE')

@section('page-title', 'Editar Inscripción')

@section('content')

<div class="page-heading">
    <div>
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
        Volver
    </a>
</div>

<section class="card form-card">

    <form
        action="{{ route('inscripciones.update', $inscripcion) }}"
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
                    value="{{ old(
                        'nombre',
                        $inscripcion->asistente->nombre
                    ) }}"
                    required
                >

                @error('nombre')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico</label>

                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="{{ old(
                        'correo',
                        $inscripcion->asistente->correo
                    ) }}"
                    required
                >

                @error('correo')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group form-group-full">
                <label for="telefono">
                    Teléfono
                    <span class="optional-label">(opcional)</span>
                </label>

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

                @error('telefono')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror
            </div>

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
                                old(
                                    'id_curso',
                                    $inscripcion->id_curso
                                ) == $curso->id_curso
                            )
                        >
                            {{ $curso->nombre }}
                        </option>
                    @endforeach
                </select>

                @error('id_curso')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="form-group form-group-full">
                <label for="estado">Estado de la inscripción</label>

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

                @error('estado')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror
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
                Guardar cambios
            </button>
        </div>

    </form>

</section>

@endsection