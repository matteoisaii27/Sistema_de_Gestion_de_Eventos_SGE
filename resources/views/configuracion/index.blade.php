@extends('layouts.admin')

@section('title', 'Configuración | SGE')

@section('page-title', 'Configuración')

@section('content')

<div class="page-heading">
    <div>
        <h1>Configuración del sistema</h1>

        <p>
            Administra los datos generales, los mensajes automáticos
            y la disponibilidad de las inscripciones.
        </p>
    </div>
</div>

<section class="card form-card">

    <form
        action="{{ route('configuracion.update', $configuracion) }}"
        method="POST"
        class="admin-form"
    >
        @csrf
        @method('PUT')

        <div class="settings-section">
            <div class="settings-section-header">
                <h3>Información general</h3>

                <p>
                    Estos datos identifican al sistema y sirven como
                    información de contacto.
                </p>
            </div>

            <div class="form-grid">

                <div class="form-group form-group-full">
                    <label for="nombre_sistema">
                        Nombre del sistema
                    </label>

                    <input
                        type="text"
                        id="nombre_sistema"
                        name="nombre_sistema"
                        value="{{ old(
                            'nombre_sistema',
                            $configuracion->nombre_sistema
                        ) }}"
                        required
                    >

                    @error('nombre_sistema')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="correo_contacto">
                        Correo de contacto
                    </label>

                    <input
                        type="email"
                        id="correo_contacto"
                        name="correo_contacto"
                        value="{{ old(
                            'correo_contacto',
                            $configuracion->correo_contacto
                        ) }}"
                        placeholder="contacto@parquecancun.org"
                    >

                    @error('correo_contacto')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telefono_contacto">
                        Teléfono de contacto
                    </label>

                    <input
                        type="text"
                        id="telefono_contacto"
                        name="telefono_contacto"
                        value="{{ old(
                            'telefono_contacto',
                            $configuracion->telefono_contacto
                        ) }}"
                        maxlength="20"
                        placeholder="998 000 0000"
                    >

                    @error('telefono_contacto')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group form-group-full">
                    <label for="direccion">
                        Dirección
                    </label>

                    <input
                        type="text"
                        id="direccion"
                        name="direccion"
                        value="{{ old(
                            'direccion',
                            $configuracion->direccion
                        ) }}"
                        placeholder="Dirección del Jardín Filosófico"
                    >

                    @error('direccion')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

            </div>
        </div>

        <div class="settings-section">
            <div class="settings-section-header">
                <h3>Mensajes automáticos</h3>

                <p>
                    Define el contenido base de los correos de confirmación
                    y recordatorio.
                </p>
            </div>

            <div class="form-grid">

                <div class="form-group form-group-full">
                    <label for="mensaje_confirmacion">
                        Mensaje de confirmación
                    </label>

                    <textarea
                        id="mensaje_confirmacion"
                        name="mensaje_confirmacion"
                        rows="6"
                        placeholder="Escribe el mensaje que recibirá el asistente al completar su inscripción."
                    >{{ old(
                        'mensaje_confirmacion',
                        $configuracion->mensaje_confirmacion
                    ) }}</textarea>

                    @error('mensaje_confirmacion')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group form-group-full">
                    <label for="mensaje_recordatorio">
                        Mensaje de recordatorio
                    </label>

                    <textarea
                        id="mensaje_recordatorio"
                        name="mensaje_recordatorio"
                        rows="6"
                        placeholder="Escribe el mensaje que se enviará antes del curso."
                    >{{ old(
                        'mensaje_recordatorio',
                        $configuracion->mensaje_recordatorio
                    ) }}</textarea>

                    @error('mensaje_recordatorio')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

            </div>
        </div>

        <div class="settings-section">
            <div class="settings-section-header">
                <h3>Disponibilidad de inscripciones</h3>

                <p>
                    Permite activar o desactivar temporalmente
                    el registro público.
                </p>
            </div>

            <div class="switch-card">

                <div>
                    <strong>Inscripciones habilitadas</strong>

                    <p>
                        Cuando esta opción está activa, los usuarios
                        pueden registrarse a los cursos disponibles.
                    </p>
                </div>

                <label class="switch">
                    <input
                        type="checkbox"
                        name="inscripciones_habilitadas"
                        value="1"
                        @checked(
                            old(
                                'inscripciones_habilitadas',
                                $configuracion->inscripciones_habilitadas
                            )
                        )
                    >

                    <span class="switch-slider"></span>
                </label>

            </div>
        </div>

        <div class="settings-footer">

            <span>
                Última actualización:
                {{ optional(
                    $configuracion->fecha_actualizacion
                )->format('d/m/Y H:i') ?? 'Sin actualizar' }}
            </span>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Guardar configuración
            </button>

        </div>

    </form>

</section>

@endsection