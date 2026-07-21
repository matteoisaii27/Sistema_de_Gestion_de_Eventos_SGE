<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id('id_configuracion');

            $table->string('nombre_sistema', 150)
                ->default('Sistema de Gestión de Eventos');

            $table->string('correo_contacto', 150)
                ->nullable();

            $table->string('telefono_contacto', 20)
                ->nullable();

            $table->string('direccion', 255)
                ->nullable();

            $table->text('mensaje_confirmacion')
                ->nullable();

            $table->text('mensaje_recordatorio')
                ->nullable();

            $table->boolean('inscripciones_habilitadas')
                ->default(true);

            $table->timestamp('fecha_actualizacion')
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};