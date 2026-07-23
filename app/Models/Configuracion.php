<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';

    protected $primaryKey = 'id_configuracion';

    protected $fillable = [
        'nombre_sistema',
        'correo_contacto',
        'telefono_contacto',
        'direccion',
        'mensaje_confirmacion',
        'mensaje_recordatorio',
        'inscripciones_habilitadas',
        'imagen_principal',
    ];

    protected $casts = [
        'inscripciones_habilitadas' => 'boolean',
        'fecha_actualizacion' => 'datetime',
    ];
}