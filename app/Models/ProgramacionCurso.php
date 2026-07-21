<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramacionCurso extends Model
{
    protected $table = 'programacion_cursos';

    protected $primaryKey = 'id_programacion';

    protected $fillable = [
        'id_curso',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    public function curso()
    {
        return $this->belongsTo(
            Curso::class,
            'id_curso',
            'id_curso'
        );
    }
}