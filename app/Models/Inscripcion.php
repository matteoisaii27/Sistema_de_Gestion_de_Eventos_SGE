<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $primaryKey = 'id_inscripcion';

    protected $fillable = [
        'id_asistente',
        'id_curso',
        'estado',
        'recordatorio_7_dias_enviado_at',
        'recordatorio_1_dia_enviado_at',
    ];

    protected function casts(): array
{
    return [
        'recordatorio_7_dias_enviado_at' => 'datetime',
        'recordatorio_1_dia_enviado_at' => 'datetime',
    ];
}

    public function asistente()
    {
        return $this->belongsTo(
            Asistente::class,
            'id_asistente',
            'id_asistente'
        );
    }

    public function curso()
    {
        return $this->belongsTo(
            Curso::class,
            'id_curso',
            'id_curso'
        );
    }
}