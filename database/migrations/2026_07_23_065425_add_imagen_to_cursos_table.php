<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega la ruta de la imagen a cada curso.
     */
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table
                ->string('imagen')
                ->nullable()
                ->after('descripcion');
        });
    }

    /**
     * Elimina la columna si se revierte la migración.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};