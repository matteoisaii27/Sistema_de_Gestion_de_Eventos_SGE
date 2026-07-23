@extends('layouts.admin')

@section('title', 'Gestión de Docentes | SGE')
@section('page-title', 'Gestión de Docentes')

@section('content')

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Equipo académico
        </span>

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
        <svg
            class="btn-icon"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path d="M12 5v14M5 12h14"/>
        </svg>

        Nuevo docente
    </a>

</div>

<section class="teacher-summary">

    <article class="teacher-summary-card summary-turquoise">

        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="12" cy="8" r="4"/>
                <path d="M4.5 21a7.5 7.5 0 0 1 15 0"/>
            </svg>
        </div>

        <div>
            <span>Docentes registrados</span>
            <strong>{{ $docentes->count() }}</strong>
        </div>

    </article>

    <article class="teacher-summary-card summary-purple">

        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M4 4h16v16H4z"/>
                <path d="M4 7l8 6 8-6"/>
            </svg>
        </div>

        <div>
            <span>Correos registrados</span>
            <strong>
                {{ $docentes->whereNotNull('correo')->count() }}
            </strong>
        </div>

    </article>

    <article class="teacher-summary-card summary-orange">

        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
        </div>

        <div>
            <span>Con biografía</span>
            <strong>
                {{ $docentes->filter(fn ($docente) => !empty($docente->bio))->count() }}
            </strong>
        </div>

    </article>

</section>

<section class="card">

    <div class="table-toolbar">

        <div>
            <span class="panel-kicker panel-kicker-turquoise">
                Directorio
            </span>

            <h3>Docentes registrados</h3>

            <p>
                {{ $docentes->count() }}
                {{ $docentes->count() === 1
                    ? 'docente registrado'
                    : 'docentes registrados' }}
            </p>
        </div>

        <div class="table-toolbar-badge teacher-toolbar-badge">
            Directorio académico
        </div>

    </div>

    <div class="table-responsive">

        <table class="data-table teachers-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Docente</th>
                    <th>Correo electrónico</th>
                    <th>Perfil profesional</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($docentes as $docente)

                    <tr>

                        <td>
                            <span class="teacher-id">
                                #{{ $docente->id_docente }}
                            </span>
                        </td>

                        <td>
                            <div class="teacher-person">

                                <div class="teacher-avatar">
                                    {{ strtoupper(substr($docente->nombre, 0, 1)) }}
                                </div>

                                <div class="teacher-person-data">
                                    <strong>
                                        {{ $docente->nombre }}
                                    </strong>

                                    <span>
                                        Docente del Jardín Filosófico
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <a
                                href="mailto:{{ $docente->correo }}"
                                class="teacher-email"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="M3 7l9 6 9-6"/>
                                </svg>

                                <span>{{ $docente->correo }}</span>
                            </a>
                        </td>

                        <td>
                            <div class="teacher-bio">
                                {{ $docente->bio ?: 'Sin biografía registrada' }}
                            </div>
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route('docentes.edit', $docente) }}"
                                    class="action-button action-edit"
                                    title="Editar docente"
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
                                    action="{{ route('docentes.destroy', $docente) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        '¿Seguro que deseas eliminar este docente?'
                                    );"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-button action-delete"
                                        title="Eliminar docente"
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
                            colspan="5"
                            class="empty-state"
                        >
                            <div class="table-empty-icon teacher-empty-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="12" cy="8" r="4"/>
                                    <path d="M4.5 21a7.5 7.5 0 0 1 15 0"/>
                                </svg>
                            </div>

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