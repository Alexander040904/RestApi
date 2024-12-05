<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    public function index()
    {
        $students = Student::all();
        if ($students->isEmpty()) {
            return response()->json(['mensage' => 'no hay estudiantes', 'status' => 404]);
        }

        $data = [
            'students' => $students,
            'estatus' => 200
        ];
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|unique:students',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:10',
            'language' => 'required'
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
            # code...
        }
        $student = Student::create($request->all());

        if (!$student) {
            # code...
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
        }
        $data = [
            'student' => $student,

            'status' => 500
        ];

        return response()->json($data, 201);

    }
    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            $data = [
                'message' => 'No se encontro estudiante',
                'status' => 404
            ];
            return response()->json($data, 404);
            # code...
        }
        $data = [
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);


    }
    public function update(Request $request, $id)
    {
        // Buscar estudiante por el identificador
        $student = Student::where('identifier', $id)->first();

        if (!$student) {
            $data = [
                'message' => 'No se encontró el estudiante',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required|min:10|max:10',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400  // Código 400 para error de validación
            ];
            return response()->json($data, 400);
        }

        // Actualizar el estudiante
        $student->update($request->all());

        // Si la actualización falla
        if (!$student) {
            $data = [
                'message' => 'Error al actualizar el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // Respuesta exitosa
        $data = [
            'student' => $student,
            'message' => 'Estudiante actualizado con éxito',
            'status' => 200  // Código 200 para éxito
        ];

        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'No se encontro estudiante',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $student->delete();
        $data = [
            'message' => 'Estudian se elimino correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);

    }
}
