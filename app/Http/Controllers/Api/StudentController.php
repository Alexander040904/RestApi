<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
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
    public function store(StoreStudentRequest $request)
    {
        // El request ya está validado en este punto
        $student = Student::create($request->validated());
        if (!$student) {

            return response()->json(['message' => 'Error al crear el estudiante',
                'status' => 500],500);
        }

        return response()->json([
            'student' => $student,
            'message' => 'Estudiante creado con éxito',
            'status' => 201
        ], 201);
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
    public function update(UpdateStudentRequest $request, $id)
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

        // Actualizar el estudiante con los datos validados
        $student->update($request->validated());

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
