<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerCursos;
use App\Http\Controllers\ControllerMain;
use App\Http\Controllers\ControllerLecciones;
use App\Http\Controllers\ControllerEstudiante;
use App\Http\Controllers\ControllerCursoEstudiante;


Route::get('/', [ControllerMain::class, 'index'])->name('home');

Route::post('/Create_curso', [ControllerCursos::class, 'store'])->name('create_curso');

Route::get('/Get_curso_by_id/{id}', [ControllerCursos::class, 'show'])->name('get_curso_by_id');

Route::put('/Update_curso_by_id/{id}', [ControllerCursos::class, 'update'])->name('update_curso_by_id');

Route::delete('/Delete_curso_by_id/{id}', [ControllerCursos::class, 'destroy'])->name('delete_curso_by_id');

Route::post('/Create_leccion', [ControllerLecciones::class, 'store'])->name('create_leccion');

Route::get('/Get_leccion_by_id/{id}', [ControllerLecciones::class, 'show'])->name('get_leccion_by_id');

Route::put('/Update_leccion_by_id/{id}', [ControllerLecciones::class, 'update'])->name('update_leccion_by_id');

Route::delete('/Delete_leccion_by_id/{id}', [ControllerLecciones::class, 'destroy'])->name('delete_leccion_by_id');

Route::post('/Create_estudiante', [ControllerEstudiante::class, 'store'])->name('create_estudiante');

Route::get('/Get_estudiante_by_id/{id}', [ControllerEstudiante::class, 'show'])->name('get_estudiante_by_id');

Route::put('/Update_estudiante_by_id/{id}', [ControllerEstudiante::class, 'update'])->name('update_estudiante_by_id');

Route::delete('/Delete_estudiante_by_id/{id}', [ControllerEstudiante::class, 'destroy'])->name('delete_estudiante_by_id');

Route::post('/Create_relacion', [ControllerCursoEstudiante::class, 'store'])->name('create_relacion');

Route::delete('/Delete_relacion_by_id/{id}', [ControllerCursoEstudiante::class, 'destroy'])->name('delete_relacion_by_id');
