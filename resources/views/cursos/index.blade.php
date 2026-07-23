@extends('layouts.admin')

@section('title', 'Gestión de Cursos | SGE')
@section('page-title', 'Gestión de Cursos')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Catálogo académico
        </span>

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
        <svg
            class="btn-icon"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path d="M12 5v14M5 12h14"/>
        </svg>

        Nuevo curso
    </a>

</div>

<section class="course-summary">

    <article class="course-summary-card summary-green">
        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
            </svg>
        </div>

        <div>
            <span>Total de cursos</span>
            <strong>{{ $cursos->count() }}</strong>
        </div>
    </article>

    <article class="course-summary-card summary-turquoise">
        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M20 6L9 17l-5-5"/>
            </svg>
        </div>

        <div>
            <span>Cursos activos</span>
            <strong>
                {{ $cursos->where('estado', 'activo')->count() }}
            </strong>
        </div>
    </article>

    <article class="course-summary-card summary-orange">
        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 7v5l3 2"/>
            </svg>
        </div>

        <div>
            <span>Cursos inactivos</span>
            <strong>
                {{ $cursos->where('estado', 'inactivo')->count() }}
            </strong>
        </div>
    </article>

</section>

<section class="card">

    <div class="table-toolbar course-table-toolbar">

        <div>
            <span class="panel-kicker panel-kicker-turquoise">
                Catálogo
            </span>

            <h3>Cursos registrados</h3>

            <p>
                {{ $cursos->count() }}
                {{ $cursos->count() === 1
                    ? 'curso registrado'
                    : 'cursos registrados' }}
            </p>
        </div>

        <div class="table-toolbar-badge">
            Información actualizada
        </div>

    </div>

    <div class="table-responsive">

        <table class="data-table courses-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Duración</th>
                    <th>Cupo</th>
                    <th>Periodo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($cursos as $curso)

                    <tr>

                        <td>
                            <span class="course-id">
                                #{{ $curso->id_curso }}
                            </span>
                        </td>

                        <td>
                            <div class="course-name-cell">

                                @if($curso->imagen)

    <img
        src="{{ asset('storage/' . $curso->imagen) }}"
        alt="{{ $curso->nombre }}"
        style="
            width:60px;
            height:60px;
            border-radius:14px;
            object-fit:cover;
            flex-shrink:0;
            border:1px solid #e5e7eb;
        "
    >

@else

    <div class="course-initial">
        {{ strtoupper(substr($curso->nombre, 0, 1)) }}
    </div>

@endif

                                <div class="course-name">
                                    <strong>
                                        {{ $curso->nombre }}
                                    </strong>

                                    <span>
                                        {{ $curso->descripcion }}
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <div class="course-detail">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>

                                <span>{{ $curso->duracion }}</span>
                            </div>
                        </td>

                        <td>
                            <div class="course-detail">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="9" cy="8" r="3"/>
                                    <path d="M3.5 20a5.5 5.5 0 0 1 11 0"/>
                                    <path d="M16 11a3 3 0 0 0 0-6"/>
                                    <path d="M17 20a5 5 0 0 0-2.5-4.33"/>
                                </svg>

                                <span>
                                    {{ $curso->cupo_maximo }} personas
                                </span>
                            </div>
                        </td>

                        <td>
                            <div class="course-period">

                                @if($curso->fecha_inicio)
                                    <strong>
                                        {{ \Carbon\Carbon::parse($curso->fecha_inicio)
                                            ->locale('es')
                                            ->translatedFormat('d M Y') }}
                                    </strong>
                                @else
                                    <strong>Sin fecha</strong>
                                @endif

                                <span>
                                    @if($curso->fecha_fin)
                                        Hasta
                                        {{ \Carbon\Carbon::parse($curso->fecha_fin)
                                            ->locale('es')
                                            ->translatedFormat('d M Y') }}
                                    @else
                                        Fecha final pendiente
                                    @endif
                                </span>

                            </div>
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
                                    class="action-button action-edit"
                                    title="Editar curso"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4z"/>
                                    </svg>

                                    <span>Editar</span>
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
                                        class="action-button action-delete"
                                        title="Eliminar curso"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path d="M3 6h18"/>
                                            <path d="M8 6V4h8v2"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M10 11v5M14 11v5"/>
                                        </svg>

                                        <span>Eliminar</span>
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
                            <div class="table-empty-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                                    <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
                                </svg>
                            </div>

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