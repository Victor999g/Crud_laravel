<?php

namespace App\Http\Controllers;

use App\Models\model_cursos;
use Illuminate\Http\Request;
use App\Models\model_lecciones;
use Exception;

class ControllerLecciones extends Controller
{
    public function index()
    {
        return model_lecciones::with('cursos_belongsTo')->get();
    }


    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'select_lecciones' => 'required',
                'input_cursos_leccion' => 'required|string|max:25',
                'input_contenido_leccion' => 'required|string'
            ]);

            $leccion = model_lecciones::create([
                'curso_id' => $validator['select_lecciones'],
                'titulo' => $validator['input_cursos_leccion'],
                'contenido' => $validator['input_contenido_leccion'],

            ]);
            info('Lección creada correctamente', $leccion->toArray());
            return redirect()->back()->with('success', 'Lección creada correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }

    public function show(string $id)
    {
        $leccion = model_lecciones::find($id);
        $cursos = model_cursos::all();
        return view('lecciones', compact('leccion', 'cursos'));
    }

    public function update(Request $request, string $id)
    {
        try {

            $leccion = model_lecciones::findOrFail($id);

            $validator = $request->validate([
                'select_lecciones' => 'required',
                'input_cursos_leccion' => 'required|string|max:25',
                'input_contenido_leccion' => 'required|string'
            ]);

            $leccion->update([
                'curso_id' => $validator['select_lecciones'],
                'titulo' => $validator['input_cursos_leccion'],
                'contenido' => $validator['input_contenido_leccion'],

            ]);
            info('Lección a sido actualizada correctamente', $leccion->toArray());
            return redirect()->back()->with('success', 'Lección a sido actulizada correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }

    public function destroy(string $id)
    {
        try {
            $leccion = model_lecciones::findOrFail($id);
            $leccion->delete();
            info('Lección borrada correctamente');
            return redirect()->back()->with('success', 'Lección a sido eliminada correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }
}
