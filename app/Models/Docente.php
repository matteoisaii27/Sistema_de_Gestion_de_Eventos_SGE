<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $primaryKey = 'id_docente';

    protected $fillable = [
        'nombre',
        'correo',
        'bio',
    ];
}