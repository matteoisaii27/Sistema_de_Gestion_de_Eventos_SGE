<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    protected $table = 'asistentes';

    protected $primaryKey = 'id_asistente';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono'
    ];

    public function inscripciones()
    {
        return $this->hasMany(
            Inscripcion::class,
            'id_asistente',
            'id_asistente'
        );
    }
}