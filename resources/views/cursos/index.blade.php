@extends('layouts.admin')

@section('title', 'Gestión de Cursos | SGE')

@section('page-title', 'Gestión de Cursos')

@section('content')

<div class="page-heading">

    <div>
        <h1>Gestión de Cursos</h1>

        <p>
            Administra los cursos y talleres disponibles en el
            Jardín Filosófico de Parque Cancún.
        </p>
    </div>

    <a
        href="{{ route('cursos.create') }}"
        class="btn btn-primary"
    >
        <span>＋</span>
        Nuevo curso
    </a>

</div>

@if(session('success'))
    <div
        class="alert alert-success"
        role="alert"
    >
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div
        class="alert alert-error"
        role="alert"
    >
        {{ session('error') }}
    </div>
@endif

<section class="card">

    <div class="table-toolbar">

        <div>
            <h3>Cursos registrados</h3>

            <span>
                {{ $cursos->count() }}
                {{ $cursos->count() === 1 ? 'curso registrado' : 'cursos registrados' }}
            </span>
        </div>

    </div>

    <div class="table-responsive">

        <table class="data-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Duración</th>
                    <th>Cupo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($cursos as $curso)

                    <tr>

                        <td>
                            #{{ $curso->id_curso }}
                        </td>

                        <td>
                            <div class="course-name">
                                <strong>
                                    {{ $curso->nombre }}
                                </strong>

                                <span>
                                    {{ $curso->descripcion }}
                                </span>
                            </div>
                        </td>

                        <td>
                            {{ $curso->duracion }}
                        </td>

                        <td>
                            {{ $curso->cupo_maximo }} personas
                        </td>

                        <td>
                            <span
                                class="status
                                {{ $curso->estado === 'activo'
                                    ? 'status-active'
                                    : 'status-inactive' }}"
                            >
                                {{ ucfirst($curso->estado) }}
                            </span>
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route('cursos.edit', $curso) }}"
                                    class="btn btn-secondary"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route('cursos.destroy', $curso) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        '¿Seguro que deseas eliminar este curso?'
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
                            colspan="6"
                            class="empty-state"
                        >
                            <strong>
                                No hay cursos registrados
                            </strong>

                            <span>
                                Utiliza el botón “Nuevo curso” para
                                registrar el primero.
                            </span>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection