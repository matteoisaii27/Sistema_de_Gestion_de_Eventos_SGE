<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id('id_inscripcion');

            $table->unsignedBigInteger('id_asistente');
            $table->unsignedBigInteger('id_curso');

            $table->timestamp('fecha_registro')->useCurrent();
            $table->string('estado', 30)->default('confirmada');

            $table->timestamps();

            $table->foreign('id_asistente')
                ->references('id_asistente')
                ->on('asistentes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_curso')
                ->references('id_curso')
                ->on('cursos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(
                ['id_asistente', 'id_curso'],
                'inscripciones_asistente_curso_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};