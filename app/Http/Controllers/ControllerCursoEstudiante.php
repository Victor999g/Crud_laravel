<?php

namespace App\Http\Controllers;

use App\Models\model_curso_estudiante;
use Exception;
use Illuminate\Http\Request;

class ControllerCursoEstudiante extends Controller
{
    public function index() {}

    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'curso_id' => 'required',
                'estudiante_id' => 'required'
            ]);

            $relacion = model_curso_estudiante::create([
                'curso_id' => $validator['curso_id'],
                'estudiante_id' => $validator['estudiante_id'],
            ]);
            info('Subscripcion agregada correctamente', $relacion->toArray());
            return redirect()->back()->with('success', 'Subscripcion agregada correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }

    public function show(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        try {
            $relacion = model_curso_estudiante::findOrFail($id);
            $relacion->delete();
            info('Subscripcion borrada correctamente');
            return redirect()->back()->with('success', 'Subcripcion a sido eliminada correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }
}
