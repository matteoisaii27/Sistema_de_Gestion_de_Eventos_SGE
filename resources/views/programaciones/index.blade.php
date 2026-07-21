@extends('layouts.admin')

@section('title', 'Programación de Cursos | SGE')

@section('page-title', 'Programación de Cursos')

@section('content')

<div class="page-heading">
    <div>
        <h1>Programación de Cursos</h1>

        <p>
            Administra las fechas y horarios asignados
            a cada curso o taller.
        </p>
    </div>

    <a
        href="{{ route('programaciones.create') }}"
        class="btn btn-primary"
    >
        <span>＋</span>
        Nueva programación
    </a>
</div>

<section class="card">

    <div class="table-toolbar">
        <div>
            <h3>Programaciones registradas</h3>

            <span>
                {{ $programaciones->count() }}
                {{ $programaciones->count() === 1
                    ? 'programación registrada'
                    : 'programaciones registradas' }}
            </span>
        </div>
    </div>

    <div class="table-responsive">

        <table class="data-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Fecha</th>
                    <th>Hora de inicio</th>
                    <th>Hora de fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($programaciones as $programacion)

                    <tr>
                        <td>
                            #{{ $programacion->id_programacion }}
                        </td>

                        <td>
                            <strong>
                                {{ $programacion->curso->nombre }}
                            </strong>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse(
                                $programacion->fecha
                            )->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse(
                                $programacion->hora_inicio
                            )->format('H:i') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse(
                                $programacion->hora_fin
                            )->format('H:i') }}
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'programaciones.edit',
                                        $programacion
                                    ) }}"
                                    class="btn btn-secondary"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route(
                                        'programaciones.destroy',
                                        $programacion
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        '¿Seguro que deseas eliminar esta programación?'
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
                                No hay programaciones registradas
                            </strong>

                            <span>
                                Utiliza el botón “Nueva programación”
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