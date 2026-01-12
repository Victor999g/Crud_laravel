<?php

namespace App\Http\Controllers;

use App\Models\model_cursos;
use Illuminate\Http\Request;
use App\Models\model_estudiante;
use Exception;
use Illuminate\Support\Facades\Hash;

class ControllerEstudiante extends Controller
{

    public function index()
    {
        return model_estudiante::all();
    }

    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'input_name_estudiante' => 'required|string',
                'input_phone_estudiante' => 'required|string|max:10',
                'input_email_estudiante' => 'required|email|unique:estudiantes,correo',
                'input_password_estudiante' => 'required|string|min:6',
            ]);

            $estudiantes = model_estudiante::create([
                'nombre' => $validator['input_name_estudiante'],
                'phone' => $validator['input_phone_estudiante'],
                'correo' => $validator['input_email_estudiante'],
                'password' => Hash::make($validator['input_password_estudiante'])

            ]);
            info('Estudiante creado correctamente', $estudiantes->toArray());
            return redirect()->back()->with('success', 'Estudiante creado correctamente correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }


    public function show(string $id)
    {
        $estudiante = model_estudiante::find($id);
        $allcursos = model_cursos::all();
        return view('estudiantes', compact('estudiante', 'allcursos'));
    }

    public function update(Request $request, string $id)
    {
        try {

            $estudiante = model_estudiante::findOrFail($id);

            $validator = $request->validate([
                'input_name_estudiante' => 'required|string',
                'input_phone_estudiante' => 'required|string|max:10',
                'input_email_estudiante' => 'required|email|unique:estudiantes,correo,' . $id,
                'input_password_estudiante' => 'nullable|string|min:6',
            ]);

            $data = [
                'nombre' => $validator['input_name_estudiante'],
                'phone' => $validator['input_phone_estudiante'],
                'correo' => $validator['input_email_estudiante'],
            ];

            if (!empty($validator['input_password_estudiante'])) {
                $data['password'] = Hash::make($validator['input_password_estudiante']);
            }

            $estudiante->update($data);


            info('Estudiante actualizado correctamente', $estudiante->toArray());
            return redirect()->back()->with('success', 'Estudiante actualizado correctamente ');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }

    public function destroy(string $id)
    {
        try {
            $estudiante = model_estudiante::findOrFail($id);
            $estudiante->delete();
            info('Estudiante borrado correctamente');
            return redirect()->back()->with('success', 'Estudiante borrado correctamente');
        } catch (Exception $e) {
            info('error al crear curso', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrio un error');
        }
    }

}
