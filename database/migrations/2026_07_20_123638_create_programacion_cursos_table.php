<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programacion_cursos', function (Blueprint $table) {
            $table->id('id_programacion');

            $table->unsignedBigInteger('id_curso');

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->timestamps();

            $table->foreign('id_curso')
                ->references('id_curso')
                ->on('cursos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programacion_cursos');
    }
};