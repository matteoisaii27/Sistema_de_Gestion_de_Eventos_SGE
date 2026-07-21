@extends('layouts.publico')

@section('title', 'Inscripción | ' . $curso->nombre)

@section('content')

<section class="registration-section">

    <div class="public-container registration-grid">

        <div class="registration-summary">

            <span class="section-label">
                Inscripción
            </span>

            <h1>
                {{ $curso->nombre }}
            </h1>

            <p>
                Completa tus datos para reservar tu lugar
                en este curso.
            </p>

            <article class="registration-course-card">

                <div class="registration-image-placeholder">
                    Imagen del curso
                </div>

                <div class="registration-course-content">

                    <h2>
                        {{ $curso->nombre }}
                    </h2>

                    <div class="registration-course-data">

                        <span>
                            <strong>Duración:</strong>
                            {{ $curso->duracion }}
                        </span>

                        <span>
                            <strong>Inicio:</strong>
                            {{ \Carbon\Carbon::parse(
                                $curso->fecha_inicio
                            )->format('d/m/Y') }}
                        </span>

                        <span>
                            <strong>Cupo disponible:</strong>
                            {{ $lugaresDisponibles }}
                        </span>

                    </div>

                </div>

            </article>

        </div>

        <div class="registration-form-card">

            @if(!$inscripcionesHabilitadas)

                <div class="public-alert public-alert-warning">
                    Las inscripciones se encuentran temporalmente
                    deshabilitadas.
                </div>

            @elseif($lugaresDisponibles <= 0)

                <div class="public-alert public-alert-warning">
                    Este curso ya alcanzó su cupo máximo.
                </div>

            @else

                <h2>Datos del asistente</h2>

                <p class="registration-form-description">
                    Verifica que tu correo sea correcto antes de enviar.
                </p>

                @if($errors->has('inscripcion'))
                    <div class="public-alert public-alert-error">
                        {{ $errors->first('inscripcion') }}
                    </div>
                @endif

                <form
                    action="{{ route(
                        'publico.inscripcion.guardar',
                        $curso
                    ) }}"
                    method="POST"
                    class="public-form"
                >
                    @csrf

                    <div class="public-form-group">
                        <label for="nombre">
                            Nombre completo
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            required
                        >

                        @error('nombre')
                            <small class="public-form-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="public-form-group">
                        <label for="correo">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            value="{{ old('correo') }}"
                            required
                        >

                        @error('correo')
                            <small class="public-form-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="public-form-group">
                        <label for="correo_confirmation">
                            Confirmar correo electrónico
                        </label>

                        <input
                            type="email"
                            id="correo_confirmation"
                            name="correo_confirmation"
                            value="{{ old('correo_confirmation') }}"
                            required
                        >

                        @error('correo_confirmation')
                            <small class="public-form-error">
                                Los correos electrónicos no coinciden.
                            </small>
                        @enderror
                    </div>

                    <div class="public-form-group">
                        <label for="telefono">
                            Teléfono
                            <span>(opcional)</span>
                        </label>

                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            value="{{ old('telefono') }}"
                            maxlength="20"
                        >

                        @error('telefono')
                            <small class="public-form-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="registration-form-actions">

                        <a
                            href="{{ route(
                                'publico.detalle',
                                $curso
                            ) }}"
                            class="public-button public-button-secondary"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="public-button public-submit-button"
                        >
                            Confirmar inscripción
                        </button>

                    </div>

                </form>

            @endif

        </div>

    </div>

</section>

@endsection