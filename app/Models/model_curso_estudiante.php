<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_curso_estudiante extends Model
{
    use HasFactory;

    protected $table = 'curso_estudiante';

    protected $fillable = [
        'curso_id',
        'estudiante_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
