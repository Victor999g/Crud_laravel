<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_cursos extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'titulo',
        'descripcion',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function lecciones_hasMany()
    {
        return $this->hasMany(model_lecciones::class, 'curso_id');
    }

    public function estudiantes_belongsToMany()
    {
        return $this->belongsToMany(
            model_estudiante::class,
            'curso_estudiante',
            'curso_id',
            'estudiante_id'
        )->withPivot('id');
    }
}
