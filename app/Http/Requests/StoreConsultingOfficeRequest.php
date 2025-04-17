<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultingOfficeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email'=>'required|email|unique:consulting_offices,email',
            'phone'=>'required|string|max:20', 
            'page_web'=>'required|string|max:255',
            'city_id' => 'required|integer|exists:cities,id',
            'country_id' => 'required|integer|exists:countries,id',
            'department_id' => 'required|integer|exists:departments,id',
            'address' => 'required|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'city_id.required' => 'La ciudad es obligatoria.',
            'city_id.integer' => 'El ID de la ciudad debe ser un número entero.',
            'city_id.exists' => 'La ciudad seleccionada no existe.',

            'country_id.required' => 'El país es obligatorio.',
            'country_id.integer' => 'El ID del país debe ser un número entero.',
            'country_id.exists' => 'El país seleccionado no existe.',

            'department_id.required' => 'El departamento es obligatorio.',
            'department_id.integer' => 'El ID del departamento debe ser un número entero.',
            'department_id.exists' => 'El departamento seleccionado no existe.',

            'address.required' => 'La dirección es obligatoria.',
            'address.string' => 'La dirección debe ser un texto.',
            'address.max' => 'La dirección no puede tener más de 255 caracteres.',

            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            
            'phone.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone.max' => 'El número de teléfono no debe exceder los 20 caracteres.',
            
            'page_web.string' => 'La página web debe ser una cadena de texto.',
            'page_web.max' => 'La URL de la página web no debe exceder los 255 caracteres.',
        ];
    }
}
