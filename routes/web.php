<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ProgramacionCursoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\SitioPublicoController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('publico.inicio');
});

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
| Estas rutas pueden abrirse sin iniciar sesión.
*/

Route::get(
    '/inicio',
    [SitioPublicoController::class, 'inicio']
)->name('publico.inicio');

Route::get(
    '/cursos-disponibles',
    [SitioPublicoController::class, 'cursos']
)->name('publico.cursos');

Route::get(
    '/curso/{curso}',
    [SitioPublicoController::class, 'detalle']
)->name('publico.detalle');

Route::get(
    '/calendario',
    [SitioPublicoController::class, 'calendario']
)->name('publico.calendario');

Route::get(
    '/curso/{curso}/inscripcion',
    [SitioPublicoController::class, 'mostrarInscripcion']
)->name('publico.inscripcion');

Route::post(
    '/curso/{curso}/inscripcion',
    [SitioPublicoController::class, 'guardarInscripcion']
)->name('publico.inscripcion.guardar');

Route::get(
    '/inscripcion/{inscripcion}/confirmacion',
    [SitioPublicoController::class, 'confirmacion']
)->name('publico.confirmacion');

/*
|--------------------------------------------------------------------------
| Inicio de sesión
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/login',
        [AuthController::class, 'mostrarLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'iniciarSesion']
    )->name('login.iniciar');

});

Route::post(
    '/logout',
    [AuthController::class, 'cerrarSesion']
)
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Panel administrativo
|--------------------------------------------------------------------------
| Todo lo que esté dentro de este grupo requiere iniciar sesión.
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::resource(
        'cursos',
        CursoController::class
    );

    Route::resource(
        'docentes',
        DocenteController::class
    );

    Route::resource(
        'programaciones',
        ProgramacionCursoController::class
    )->except(['show']);

    Route::resource(
        'inscripciones',
        InscripcionController::class
    )
        ->except(['show'])
        ->parameters([
            'inscripciones' => 'inscripcion'
        ]);

    Route::get(
        '/configuracion',
        [ConfiguracionController::class, 'index']
    )->name('configuracion.index');

    Route::put(
        '/configuracion/{configuracion}',
        [ConfiguracionController::class, 'update']
    )->name('configuracion.update');

    Route::get(
        '/estadisticas',
        [EstadisticaController::class, 'index']
    )->name('estadisticas.index');

});