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
            <div class="logo-space">
                <span>Espacio para logotipo</span>
            </div>

            <div class="system-name">
                <strong>SGE</strong>
                <small>Panel administrativo</small>
            </div>
        </div>

        <nav class="sidebar-nav">

            <a
    href="{{ route('dashboard') }}"
    class="nav-link
        {{ request()->routeIs('dashboard')
            ? 'active'
            : '' }}"
>
    <span class="nav-icon">▦</span>
    <span>Dashboard</span>
</a>

            <a
                href="{{ route('cursos.index') }}"
                class="nav-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▣</span>
                <span>Cursos</span>
            </a>

            <a
    href="{{ route('docentes.index') }}"
    class="nav-link {{ request()->routeIs('docentes.*') ? 'active' : '' }}"
>
    <span class="nav-icon">♙</span>
    <span>Docentes</span>
</a>

            <a
    href="{{ route('programaciones.index') }}"
    class="nav-link
        {{ request()->routeIs('programaciones.*')
            ? 'active'
            : '' }}"
>
    <span class="nav-icon">□</span>
    <span>Programación</span>
</a>

            <a
    href="{{ route('inscripciones.index') }}"
    class="nav-link
        {{ request()->routeIs('inscripciones.*')
            ? 'active'
            : '' }}"
>
    <span class="nav-icon">✓</span>
    <span>Inscripciones</span>
</a>

            <a
    href="{{ route('estadisticas.index') }}"
    class="nav-link
        {{ request()->routeIs('estadisticas.*')
            ? 'active'
            : '' }}"
>
    <span class="nav-icon">▥</span>
    <span>Estadísticas</span>
</a>

            <a
    href="{{ route('configuracion.index') }}"
    class="nav-link
        {{ request()->routeIs('configuracion.*')
            ? 'active'
            : '' }}"
>
    <span class="nav-icon">⚙</span>
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
            <span class="nav-icon">↪</span>
            <span>Cerrar sesión</span>
        </button>

    </form>

</div> 

    </aside>

    <div class="main-area">

        <header class="topbar">

            <div>
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