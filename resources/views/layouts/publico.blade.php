<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Cursos, talleres y actividades del Jardín Filosófico de Parque Cancún."
    >

    <title>
        @yield('title', 'Jardín Filosófico | Parque Cancún')
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/publico.css') }}"
    >
</head>

<body>

<header class="public-header" id="public-header">

    <div class="public-header-accent">
        <span class="accent-green"></span>
        <span class="accent-turquoise"></span>
        <span class="accent-orange"></span>
        <span class="accent-pink"></span>
        <span class="accent-purple"></span>
    </div>

    <div class="public-container public-header-content">

        <a
            href="{{ route('publico.inicio') }}"
            class="public-brand"
            aria-label="Ir al inicio del Jardín Filosófico"
        >
            <img
                src="{{ asset('images/LOGO_SGE.png') }}"
                alt="Parque Cancún"
                class="public-brand-logo"
            >

            <span class="public-brand-divider"></span>

            <span class="public-brand-text">
                <strong>Jardín Filosófico</strong>
                <small>Sistema de Gestión de Eventos</small>
            </span>
        </a>

        <button
            type="button"
            class="public-menu-button"
            id="public-menu-button"
            aria-label="Abrir menú de navegación"
            aria-controls="public-navigation"
            aria-expanded="false"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div
            class="public-navigation-wrapper"
            id="public-navigation"
        >

            <nav
                class="public-nav"
                aria-label="Navegación principal"
            >

                <a
                    href="{{ route('publico.inicio') }}"
                    class="{{ request()->routeIs('publico.inicio')
                        ? 'active'
                        : '' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M3 11.5 12 4l9 7.5"/>
                        <path d="M5 10v10h14V10"/>
                        <path d="M9 20v-6h6v6"/>
                    </svg>

                    <span>Inicio</span>
                </a>

                <a
                    href="{{ route('publico.cursos') }}"
                    class="{{ request()->routeIs(
                        'publico.cursos',
                        'publico.detalle',
                        'publico.inscripcion',
                        'publico.confirmacion'
                    ) ? 'active' : '' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                        <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
                    </svg>

                    <span>Cursos</span>
                </a>

                <a
                    href="{{ route('publico.calendario') }}"
                    class="{{ request()->routeIs('publico.calendario')
                        ? 'active'
                        : '' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                    </svg>

                    <span>Calendario</span>
                </a>

            </nav>

            <a
                href="{{ route('publico.cursos') }}"
                class="public-header-button"
            >
                Explorar cursos

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M5 12h14"/>
                    <path d="m13 6 6 6-6 6"/>
                </svg>
            </a>

        </div>

    </div>

</header>

<main class="public-main">
    @yield('content')
</main>

<footer class="public-footer">

    <div class="public-footer-accent">
        <span class="accent-green"></span>
        <span class="accent-turquoise"></span>
        <span class="accent-orange"></span>
        <span class="accent-pink"></span>
        <span class="accent-purple"></span>
    </div>

    <div class="public-container">

        <div class="public-footer-main">

            <div class="public-footer-brand">

                <img
                    src="{{ asset('images/LOGO_SGE.png') }}"
                    alt="Parque Cancún"
                    class="public-footer-logo"
                >

                <p>
                    Un espacio para aprender, dialogar y compartir ideas
                    mediante cursos y actividades del Jardín Filosófico.
                </p>

            </div>

            <div class="public-footer-column">

                <span class="public-footer-title">
                    Explorar
                </span>

                <a href="{{ route('publico.inicio') }}">
                    Inicio
                </a>

                <a href="{{ route('publico.cursos') }}">
                    Cursos disponibles
                </a>

                <a href="{{ route('publico.calendario') }}">
                    Calendario
                </a>

            </div>

            <div class="public-footer-column">

                <span class="public-footer-title">
                    Jardín Filosófico
                </span>

                <p>
                    Cursos y actividades para fomentar el pensamiento,
                    el diálogo y la reflexión.
                </p>

                <span class="public-footer-location">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"/>
                        <circle cx="12" cy="10" r="2.5"/>
                    </svg>

                    Parque Cancún, Quintana Roo

                </span>

            </div>

        </div>

        <div class="public-footer-bottom">

            <span>
                © {{ date('Y') }} Parque Cancún.
                Todos los derechos reservados.
            </span>

            <span>
                Sistema de Gestión de Eventos
            </span>

        </div>

    </div>

</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById(
            'public-menu-button'
        );

        const navigation = document.getElementById(
            'public-navigation'
        );

        if (!menuButton || !navigation) {
            return;
        }

        function closeMenu() {
            navigation.classList.remove('is-open');
            menuButton.classList.remove('is-open');
            menuButton.setAttribute('aria-expanded', 'false');

            document.body.classList.remove(
                'public-menu-open'
            );
        }

        menuButton.addEventListener('click', function () {
            const isOpen = navigation.classList.toggle(
                'is-open'
            );

            menuButton.classList.toggle(
                'is-open',
                isOpen
            );

            menuButton.setAttribute(
                'aria-expanded',
                isOpen ? 'true' : 'false'
            );

            document.body.classList.toggle(
                'public-menu-open',
                isOpen
            );
        });

        navigation.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 820) {
                closeMenu();
            }
        });
    });
</script>

</body>
</html>