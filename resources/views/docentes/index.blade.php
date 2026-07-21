@extends('layouts.admin')

@section('title', 'Gestión de Docentes | SGE')

@section('page-title', 'Gestión de Docentes')

@section('content')

<div class="page-heading">
    <div>
        <h1>Gestión de Docentes</h1>

        <p>
            Administra la información de los docentes responsables
            de los cursos y talleres del Jardín Filosófico.
        </p>
    </div>

    <a
        href="{{ route('docentes.create') }}"
        class="btn btn-primary"
    >
        <span>＋</span>
        Nuevo docente
    </a>
</div>

<section class="card">

    <div class="table-toolbar">
        <div>
            <h3>Docentes registrados</h3>

            <span>
                {{ $docentes->count() }}
                {{ $docentes->count() === 1
                    ? 'docente registrado'
                    : 'docentes registrados' }}
            </span>
        </div>
    </div>

    <div class="table-responsive">

        <table class="data-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Docente</th>
                    <th>Correo</th>
                    <th>Biografía</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($docentes as $docente)

                    <tr>
                        <td>
                            #{{ $docente->id_docente }}
                        </td>

                        <td>
                            <strong>
                                {{ $docente->nombre }}
                            </strong>
                        </td>

                        <td>
                            {{ $docente->correo }}
                        </td>

                        <td>
                            {{ $docente->bio ?: 'Sin biografía registrada' }}
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route('docentes.edit', $docente) }}"
                                    class="btn btn-secondary"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route('docentes.destroy', $docente) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este docente?');"
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
                            colspan="5"
                            class="empty-state"
                        >
                            <strong>
                                No hay docentes registrados
                            </strong>

                            <span>
                                Utiliza el botón “Nuevo docente”
                                para registrar el primero.
                            </span>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection