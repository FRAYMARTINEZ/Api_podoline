<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

        if ($this->isMethod('post')) {
            return [
                'office_id' => 'required|integer|exists:consulting_offices,id',
                'role' => 'required|string|max:20',
                'name' => 'required|string|max:255',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'position' => 'string|max:20',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed|min:8',
            ];
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $userId = $this->route('id'); // o 'id', depende de cómo se llama el parámetro en la ruta

            return [
                'office_id' => 'sometimes|required|integer|exists:consulting_offices,id',
                'role' => 'sometimes|required|string|max:20',
                'name' => 'sometimes|required|string|max:255',
                'full_name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $userId,
                'password' => 'sometimes|required|string|confirmed|min:8',
            ];
        }

        return [];
    }


    /**
     * Mensajes personalizados de validación.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'office_id.required' => 'La oficina es obligatoria.',
            'office_id.integer' => 'El ID de la oficina debe ser un número.',
            'office_id.exists' => 'La oficina seleccionada no existe.',

            'role.required' => 'El rol es obligatorio.',
            'role.string' => 'El rol debe ser una cadena de texto.',
            'role.max' => 'El rol no debe superar los 20 caracteres.',

            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',

            'full_name.required' => 'El nombre completo es obligatorio.',
            'full_name.string' => 'El nombre completo debe ser texto.',
            'full_name.max' => 'El nombre completo no debe superar los 255 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone.max' => 'El número de teléfono no debe exceder los 20 caracteres.',
    
            'position.string' => 'El cargo debe ser una cadena de texto.',
            'position.max' => 'El cargo no debe exceder los 20 caracteres.',
        ];
    }
}
