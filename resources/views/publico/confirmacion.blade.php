@extends('layouts.publico')

@section('title', 'Inscripción confirmada | Jardín Filosófico')

@section('content')

<section class="confirmation-section">

    <div class="public-container">

        <div class="confirmation-card">

            <div class="confirmation-icon">
                ✓
            </div>

            <span class="section-label">
                Inscripción completada
            </span>

            <h1>
                ¡Tu lugar ha sido registrado!
            </h1>

            <p class="confirmation-message">
                Gracias,
                <strong>
                    {{ $inscripcion->asistente->nombre }}
                </strong>.
                Tu inscripción al curso
                <strong>
                    {{ $inscripcion->curso->nombre }}
                </strong>
                se realizó correctamente.
            </p>

            <div class="confirmation-details">

                <div class="confirmation-detail-row">
                    <span>Curso</span>

                    <strong>
                        {{ $inscripcion->curso->nombre }}
                    </strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Correo registrado</span>

                    <strong>
                        {{ $inscripcion->asistente->correo }}
                    </strong>
                </div>

                @if($inscripcion->asistente->telefono)
                    <div class="confirmation-detail-row">
                        <span>Teléfono</span>

                        <strong>
                            {{ $inscripcion->asistente->telefono }}
                        </strong>
                    </div>
                @endif

                <div class="confirmation-detail-row">
                    <span>Fecha de inscripción</span>

                    <strong>
                        {{ \Carbon\Carbon::parse(
                            $inscripcion->fecha_registro
                        )->format('d/m/Y H:i') }}
                    </strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Estado</span>

                    <strong class="confirmation-status">
                        {{ ucfirst($inscripcion->estado) }}
                    </strong>
                </div>

            </div>

            <div class="confirmation-note">

                <strong>Importante</strong>

                <p>
                    Conserva esta información. Más adelante se enviará
                    una confirmación al correo registrado.
                </p>

            </div>

            <div class="confirmation-actions">

                <a
                    href="{{ route(
                        'publico.detalle',
                        $inscripcion->curso
                    ) }}"
                    class="public-button public-button-secondary"
                >
                    Ver curso
                </a>

                <a
                    href="{{ route('publico.cursos') }}"
                    class="public-button"
                >
                    Explorar otros cursos
                </a>

            </div>

        </div>

    </div>

</section>

@endsection