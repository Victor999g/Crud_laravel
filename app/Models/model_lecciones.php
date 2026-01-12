<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_lecciones extends Model
{
    use HasFactory;

    protected $table = 'lecciones';

    protected $fillable = [
        'curso_id',
        'titulo',
        'contenido'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function cursos_belongsTo (){
        return $this->belongsTo(model_cursos::class, 'curso_id');
    }


}
