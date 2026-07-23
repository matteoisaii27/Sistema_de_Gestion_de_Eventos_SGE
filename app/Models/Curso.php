<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $primaryKey = 'id_curso';

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'duracion',
        'cupo_maximo',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function programaciones()
    {
        return $this->hasMany(
            ProgramacionCurso::class,
            'id_curso',
            'id_curso'
        );
    }

    public function inscripciones()
    {
        return $this->hasMany(
            Inscripcion::class,
            'id_curso',
            'id_curso'
        );
    }
}