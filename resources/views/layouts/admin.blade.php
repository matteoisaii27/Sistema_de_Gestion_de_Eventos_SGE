<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'Panel Administrativo | SGE')</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/admin.css') }}"
    >
</head>

<body>

<div class="admin-layout">

    <aside class="sidebar">

        <div class="sidebar-brand">

            <a
                href="{{ route('dashboard') }}"
                class="sidebar-logo-link"
                aria-label="Ir al Dashboard"
            >
                <img
                    src="{{ asset('images/logo-parque-cancun.png') }}"
                    alt="Parque Cancún"
                    class="sidebar-logo"
                >
            </a>

            <div class="system-name">
                <strong>SGE</strong>
                <small>Sistema de Gestión de Eventos</small>
            </div>

        </div>

        <nav class="sidebar-nav">

            <a
                href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <rect x="3" y="3" width="7" height="7" rx="2"/>
                        <rect x="14" y="3" width="7" height="7" rx="2"/>
                        <rect x="3" y="14" width="7" height="7" rx="2"/>
                        <rect x="14" y="14" width="7" height="7" rx="2"/>
                    </svg>
                </span>

                <span>Dashboard</span>
            </a>

            <a
                href="{{ route('cursos.index') }}"
                class="nav-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                        <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
                    </svg>
                </span>

                <span>Cursos</span>
            </a>

            <a
                href="{{ route('docentes.index') }}"
                class="nav-link {{ request()->routeIs('docentes.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4.5 21a7.5 7.5 0 0 1 15 0"/>
                    </svg>
                </span>

                <span>Docentes</span>
            </a>

            <a
                href="{{ route('programaciones.index') }}"
                class="nav-link {{ request()->routeIs('programaciones.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <rect x="3" y="5" width="18" height="16" rx="3"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                        <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                    </svg>
                </span>

                <span>Programación</span>
            </a>

            <a
                href="{{ route('inscripciones.index') }}"
                class="nav-link {{ request()->routeIs('inscripciones.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M9 11l3 3L22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                </span>

                <span>Inscripciones</span>
            </a>

            <a
                href="{{ route('estadisticas.index') }}"
                class="nav-link {{ request()->routeIs('estadisticas.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M4 20V10"/>
                        <path d="M10 20V4"/>
                        <path d="M16 20v-7"/>
                        <path d="M22 20H2"/>
                    </svg>
                </span>

                <span>Estadísticas</span>
            </a>

            <a
                href="{{ route('configuracion.index') }}"
                class="nav-link {{ request()->routeIs('configuracion.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06A1.7 1.7 0 0 0 15 19.4a1.7 1.7 0 0 0-1 .6 1.7 1.7 0 0 0-.4 1.1V21a2 2 0 1 1-4 0v-.09A1.7 1.7 0 0 0 8.6 19.4a1.7 1.7 0 0 0-1.88.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-.6-1 1.7 1.7 0 0 0-1.1-.4H3a2 2 0 1 1 0-4h.09A1.7 1.7 0 0 0 4.6 8.6a1.7 1.7 0 0 0-.34-1.88l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-.6 1.7 1.7 0 0 0 .4-1.1V3a2 2 0 1 1 4 0v.09A1.7 1.7 0 0 0 15.4 4.6a1.7 1.7 0 0 0 1.88-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.7 1.7 0 0 0 19.4 9c.14.36.36.7.6 1 .29.34.67.4 1.1.4H21a2 2 0 1 1 0 4h-.09a1.7 1.7 0 0 0-1.51.6z"/>
                    </svg>
                </span>

                <span>Configuración</span>
            </a>

        </nav>

        <div class="sidebar-footer">

            <div class="admin-user">

                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="admin-user-data">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>{{ auth()->user()->email }}</small>
                </div>

            </div>

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="logout-form"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    <span class="nav-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <path d="M16 17l5-5-5-5"/>
                            <path d="M21 12H9"/>
                        </svg>
                    </span>

                    <span>Cerrar sesión</span>
                </button>

            </form>

        </div>

    </aside>

    <div class="main-area">

        <header class="topbar">

            <div class="topbar-heading">
                <p class="topbar-label">
                    Sistema de Gestión de Eventos
                </p>

                <h2>@yield('page-title', 'Panel administrativo')</h2>
            </div>

            <div class="topbar-user">

                <div class="user-information">
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>Administrador general</span>
                </div>

                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            </div>

        </header>

        <main class="main-content">

            @if(session('success'))
                <div class="alert alert-success">
                    <span>✓</span>

                    <div>
                        <strong>Operación realizada</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <span>!</span>

                    <div>
                        <strong>Revisa la información</strong>

                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>