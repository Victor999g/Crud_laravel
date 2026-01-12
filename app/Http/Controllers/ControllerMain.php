<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerCursos;
use App\Http\Controllers\ControllerLecciones;
use App\Http\Controllers\ControllerEstudiante;

class ControllerMain extends Controller
{
    public function index()
    {
        $cursos = (new ControllerCursos)->index();
        $lecciones = (new ControllerLecciones)->index();
        $estudiantes = (new ControllerEstudiante)->index();
        return view('welcome', compact('cursos', 'lecciones', 'estudiantes'));
    }


    public function store(Request $request) {}

    public function show(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
