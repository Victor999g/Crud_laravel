<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_cursos;
use Exception;

class ControllerCursos extends Controller
{

    public function index()
    {
        return model_cursos::all();
    }


    public function store(Request $request)
    {
        try {

            $validator = $request->validate([
                'input_cursos_titulo' => 'required|string|max:25',
                'input_cursos_descripcion' => 'required|string'
            ]);

            $curso = model_cursos::create([
                'titulo' => $validator['input_cursos_titulo'],
                'descripcion' => $validator['input_cursos_descripcion']
            ]);

            info('curso creado correctamente', $curso->toArray());
            return redirect()->back()->with('success', 'Curso creado correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }

    public function show(string $id)
    {
        $curso = model_cursos::find($id);
        return view('course', compact('curso'));
    }


    public function update(Request $request, string $id)
    {
        try {
            $curso = model_cursos::findOrFail($id);

            $validator = $request->validate([
                'input_cursos_titulo' => 'required|string|max:25',
                'input_cursos_descripcion' => 'required|string'
            ]);

            $curso->update([
                'titulo' => $validator['input_cursos_titulo'],
                'descripcion' => $validator['input_cursos_descripcion']
            ]);

            info('curso a sido actualizado correctamente', $curso->toArray());
            return redirect()->back()->with('success', 'Curso a sido actulizado correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }
    public function destroy(string $id)
    {
        try {
            $curso = model_cursos::findOrFail($id);
            $curso->delete();
            info('Curso borrado correctamente');
            return redirect()->back()->with('success', 'Curso a sido eliminada correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }
}
