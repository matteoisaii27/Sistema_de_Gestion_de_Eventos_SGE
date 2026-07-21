<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Jardín Filosófico')
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/publico.css') }}"
    >
</head>

<body>

<header class="public-header">

    <div class="public-container header-content">

        <a
            href="{{ route('publico.inicio') }}"
            class="public-logo"
        >
            <div class="logo-placeholder">
                Espacio para logotipo
            </div>
        </a>

        <nav class="public-nav">

            <a
                href="{{ route('publico.inicio') }}"
                class="{{ request()->routeIs('publico.inicio')
                    ? 'active'
                    : '' }}"
            >
                Inicio
            </a>

            <a
                href="{{ route('publico.cursos') }}"
                class="{{ request()->routeIs(
                    'publico.cursos',
                    'publico.detalle'
                ) ? 'active' : '' }}"
            >
                Cursos
            </a>

            <a
                href="{{ route('publico.calendario') }}"
                class="{{ request()->routeIs('publico.calendario')
                    ? 'active'
                    : '' }}"
            >
                Calendario
            </a>

        </nav>

    </div>

</header>

<main>
    @yield('content')
</main>

<footer class="public-footer">

    <div class="public-container footer-content">

        <div>
            <strong>Jardín Filosófico</strong>

            <p>
                Cursos y actividades para fomentar el pensamiento,
                el diálogo y la reflexión.
            </p>
        </div>

        <div>
            <span>
                Parque Cancún · 2026
            </span>
        </div>

    </div>

</footer>

</body>
</html>