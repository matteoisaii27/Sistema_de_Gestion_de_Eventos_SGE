@extends('layouts.admin')

@section('title', 'Inscripciones | SGE')

@section('page-title', 'Gestión de Inscripciones')

@section('content')

<div class="page-heading">
    <div>
        <h1>Inscripciones</h1>

        <p>
            Consulta y administra las personas inscritas
            en los cursos del Jardín Filosófico.
        </p>
    </div>

    <a
        href="{{ route('inscripciones.create') }}"
        class="btn btn-primary"
    >
        <span>＋</span>
        Nueva inscripción
    </a>
</div>

<section class="card">

    <div class="table-toolbar">
        <div>
            <h3>Inscripciones registradas</h3>

            <span>
                {{ $inscripciones->count() }}
                {{ $inscripciones->count() === 1
                    ? 'inscripción registrada'
                    : 'inscripciones registradas' }}
            </span>
        </div>
    </div>

    <div class="table-responsive">

        <table class="data-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Asistente</th>
                    <th>Contacto</th>
                    <th>Curso</th>
                    <th>Fecha de registro</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($inscripciones as $inscripcion)

                    <tr>
                        <td>
                            #{{ $inscripcion->id_inscripcion }}
                        </td>

                        <td>
                            <strong>
                                {{ $inscripcion->asistente->nombre }}
                            </strong>
                        </td>

                        <td>
                            <div>
                                {{ $inscripcion->asistente->correo }}
                            </div>

                            <small>
                                {{ $inscripcion->asistente->telefono
                                    ?: 'Sin teléfono' }}
                            </small>
                        </td>

                        <td>
                            {{ $inscripcion->curso->nombre }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse(
                                $inscripcion->fecha_registro
                            )->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            <span class="status-badge
                                {{ $inscripcion->estado === 'confirmada'
                                    ? 'status-active'
                                    : '' }}
                            ">
                                {{ ucfirst($inscripcion->estado) }}
                            </span>
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'inscripciones.edit',
                                        $inscripcion
                                    ) }}"
                                    class="btn btn-secondary"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route(
                                        'inscripciones.destroy',
                                        $inscripcion
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        '¿Seguro que deseas eliminar esta inscripción?'
                                    );"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="7"
                            class="empty-state"
                        >
                            <strong>
                                No hay inscripciones registradas
                            </strong>

                            <span>
                                Utiliza el botón “Nueva inscripción”
                                para registrar la primera.
                            </span>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection