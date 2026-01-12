<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'nombre',
        'phone',
        'correo',
        'password'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

    public function curso_belongsToMany()
    {
        return $this->belongsToMany(
            model_cursos::class,
            'curso_estudiante',
            'estudiante_id',
            'curso_id'
        )->withPivot('id');
    }
}
