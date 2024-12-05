<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'email' => 'required|email',
            'phone' => 'required|min:10|max:10',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // En lugar de redirigir, devolvemos una respuesta JSON de error
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'message' => 'Error en la validación',
            'errors' => $validator->errors(),
            'status' => 400,
        ], 400));
    }
}
