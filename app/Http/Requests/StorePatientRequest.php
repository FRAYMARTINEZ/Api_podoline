<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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

        $id = $this->route('id') ?? null;

        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'type_document' => 'required|string',
                'number_document' => 'required|string|unique:patients',
                'date_of_birth' => 'required|date|before:today',
                'email' => 'required|email|unique:patients',
                'cellphone' => 'required|string',
                'gender_id' => 'required|integer|exists:genders,id'
            ];
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {

            return  [
                'name' => 'sometimes|required|string',
                'last_name' => 'sometimes|required|string',
                'type_document' => 'sometimes|required|string',
                'number_document' => 'sometimes|required|string|unique:patients,number_document,' . $id,
                'date_of_birth' => 'sometimes|required|date|before:today',
                'email' => 'sometimes|required|email|unique:patients,email,' . $id,
                'cellphone' => 'sometimes|required|string',
                'gender_id' => 'required|integer|exists:genders,id'
            ];
        }

        return [];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.string' => 'El apellido debe ser una cadena de texto.',
            'type_document.required' => 'El tipo de documento es obligatorio.',
            'type_document.string' => 'El tipo de documento debe ser una cadena de texto.',
            'number_document.required' => 'El número de documento es obligatorio.',
            'number_document.string' => 'El número de documento debe ser una cadena de texto.',
            'number_document.unique' => 'El número de documento ya está registrado.',
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_of_birth.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'date_of_birth.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'cellphone.required' => 'El número de celular es obligatorio.',
            'cellphone.string' => 'El número de celular debe ser una cadena de texto.',
        ];
    }
}