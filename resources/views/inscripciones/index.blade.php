@extends('layouts.admin')

@section('title', 'Inscripciones | SGE')
@section('page-title', 'Gestión de Inscripciones')

@section('content')

@php
    $totalInscripciones = $inscripciones->count();

    $confirmadas = $inscripciones
        ->where('estado', 'confirmada')
        ->count();

    $pendientes = $inscripciones
        ->where('estado', 'pendiente')
        ->count();

    $canceladas = $inscripciones
        ->where('estado', 'cancelada')
        ->count();

    $cursosConInscripciones = $inscripciones
        ->pluck('id_curso')
        ->unique()
        ->count();
@endphp

<div class="page-heading">

    <div>
        <span class="page-eyebrow">
            Participantes
        </span>

        <h1>Gestión de Inscripciones</h1>

        <p>
            Consulta y administra las personas inscritas
            en los cursos del Jardín Filosófico.
        </p>
    </div>

    <a
        href="{{ route('inscripciones.create') }}"
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

        Nueva inscripción
    </a>

</div>

<section class="enrollment-summary">

    <article class="enrollment-summary-card summary-purple">

        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="9" cy="8" r="4"/>
                <path d="M2.5 21a6.5 6.5 0 0 1 13 0"/>
                <path d="M17 8h5M19.5 5.5v5"/>
            </svg>
        </div>

        <div>
            <span>Total de inscripciones</span>
            <strong>{{ $totalInscripciones }}</strong>
        </div>

    </article>

    <article class="enrollment-summary-card summary-green">

        <div class="summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                aria-hidden="true"
            >
                <circle cx="12" cy="12" r="9"/>
                <path d="M8 12l3 3 5-6"/>
            </svg>
        </div>

        <div>
            <span>Confirmadas</span>
            <strong>{{ $confirmadas }}</strong>
        </div>

    </article>

    <article class="enrollment-summary-card summary-orange">

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
            <span>Pendientes</span>
            <strong>{{ $pendientes }}</strong>
        </div>

    </article>

    <article class="enrollment-summary-card summary-turquoise">

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
            <span>Cursos con inscritos</span>
            <strong>{{ $cursosConInscripciones }}</strong>
        </div>

    </article>

</section>

<section class="card">

    <div class="table-toolbar">

        <div>
            <span class="panel-kicker panel-kicker-purple">
                Registro de participantes
            </span>

            <h3>Inscripciones registradas</h3>

            <p>
                {{ $totalInscripciones }}
                {{ $totalInscripciones === 1
                    ? 'inscripción registrada'
                    : 'inscripciones registradas' }}
            </p>
        </div>

        <div class="enrollment-toolbar-status">

            <span class="enrollment-counter counter-confirmed">
                {{ $confirmadas }} confirmadas
            </span>

            <span class="enrollment-counter counter-pending">
                {{ $pendientes }} pendientes
            </span>

            @if($canceladas > 0)
                <span class="enrollment-counter counter-cancelled">
                    {{ $canceladas }} canceladas
                </span>
            @endif

        </div>

    </div>

    <div class="table-responsive">

        <table class="data-table enrollments-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Asistente</th>
                    <th>Contacto</th>
                    <th>Curso</th>
                    <th>Registro</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($inscripciones as $inscripcion)

                    @php
                        $nombre = $inscripcion->asistente->nombre;

                        $partesNombre = preg_split(
                            '/\s+/',
                            trim($nombre)
                        );

                        $iniciales = collect($partesNombre)
                            ->filter()
                            ->take(2)
                            ->map(
                                fn ($parte) =>
                                    strtoupper(
                                        mb_substr($parte, 0, 1)
                                    )
                            )
                            ->implode('');

                        $fechaRegistro = \Carbon\Carbon::parse(
                            $inscripcion->fecha_registro
                        );
                    @endphp

                    <tr>

                        <td>
                            <span class="enrollment-id">
                                #{{ $inscripcion->id_inscripcion }}
                            </span>
                        </td>

                        <td>
                            <div class="enrollment-person">

                                <div class="enrollment-avatar">
                                    {{ $iniciales }}
                                </div>

                                <div class="enrollment-person-data">
                                    <strong>
                                        {{ $nombre }}
                                    </strong>

                                    <span>
                                        Asistente registrado
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <div class="enrollment-contact">

                                <a
                                    href="mailto:{{ $inscripcion->asistente->correo }}"
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

                                    <span>
                                        {{ $inscripcion->asistente->correo }}
                                    </span>
                                </a>

                                <span class="enrollment-phone">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path d="M5 4h4l2 5-3 2a15 15 0 0 0 5 5l2-3 5 2v4a2 2 0 0 1-2 2C10 21 3 14 3 6a2 2 0 0 1 2-2z"/>
                                    </svg>

                                    {{ $inscripcion->asistente->telefono
                                        ?: 'Sin teléfono' }}
                                </span>

                            </div>
                        </td>

                        <td>
                            <div class="enrollment-course">

                                <div class="enrollment-course-icon">
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
                                    <strong>
                                        {{ $inscripcion->curso->nombre }}
                                    </strong>

                                    <span>
                                        Curso seleccionado
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <div class="enrollment-date">

                                <div class="enrollment-date-icon">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                                        <path d="M16 3v4M8 3v4M3 10h18"/>
                                    </svg>
                                </div>

                                <div>
                                    <strong>
                                        {{ $fechaRegistro->format('d/m/Y') }}
                                    </strong>

                                    <span>
                                        {{ $fechaRegistro->format('H:i') }} h
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            @if($inscripcion->estado === 'confirmada')

                                <span class="enrollment-status status-confirmed">
                                    <i></i>
                                    Confirmada
                                </span>

                            @elseif($inscripcion->estado === 'pendiente')

                                <span class="enrollment-status status-pending">
                                    <i></i>
                                    Pendiente
                                </span>

                            @else

                                <span class="enrollment-status status-cancelled">
                                    <i></i>
                                    Cancelada
                                </span>

                            @endif
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'inscripciones.edit',
                                        $inscripcion
                                    ) }}"
                                    class="action-button action-edit"
                                    title="Editar inscripción"
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
                                        class="action-button action-delete"
                                        title="Eliminar inscripción"
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
                            <div class="table-empty-icon enrollment-empty-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <circle cx="9" cy="8" r="4"/>
                                    <path d="M2.5 21a6.5 6.5 0 0 1 13 0"/>
                                    <path d="M17 8h5M19.5 5.5v5"/>
                                </svg>
                            </div>

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