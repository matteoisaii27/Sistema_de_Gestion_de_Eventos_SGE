<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Acceso administrativo | SGE</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/admin.css') }}"
    >
</head>

<body class="login-body">

    <main class="login-page">

        <section class="login-brand-panel">

            <div class="login-logo-placeholder">
                Espacio para logotipo
            </div>

            <div class="login-brand-content">

                <span>
                    Jardín Filosófico
                </span>

                <h1>
                    Sistema de Gestión de Eventos
                </h1>

                <p>
                    Panel para administrar cursos, docentes,
                    programaciones e inscripciones.
                </p>

            </div>

        </section>

        <section class="login-form-panel">

            <div class="login-form-container">

                <div class="login-heading">

                    <span>Panel administrativo</span>

                    <h2>Iniciar sesión</h2>

                    <p>
                        Ingresa tus credenciales para acceder al sistema.
                    </p>

                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form
                    action="{{ route('login.iniciar') }}"
                    method="POST"
                    class="login-form"
                >
                    @csrf

                    <div class="form-group">
                        <label for="email">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                            autofocus
                        >

                        @error('email')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required
                        >

                        @error('password')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <label class="remember-option">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <span>
                            Mantener sesión iniciada
                        </span>
                    </label>

                    <button
                        type="submit"
                        class="btn btn-primary login-submit"
                    >
                        Ingresar al panel
                    </button>

                </form>

            </div>

        </section>

    </main>

</body>
</html>
