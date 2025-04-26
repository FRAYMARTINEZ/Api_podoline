<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttentionRequest extends FormRequest
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
            'patient_id' => 'required|integer|exists:patients,id',
            'appointment_date' => 'nullable|date',
            'shoe_size' => 'nullable|numeric|min:1|max:50',
            'footstep_type_left' => 'nullable|string|max:255',
            'footstep_type_right' => 'nullable|string|max:255',
            'foot_type_left' => 'nullable|string|max:255',
            'foot_type_right' => 'nullable|string|max:255',
            'heel_type_left' => 'nullable|string|max:255',
            'heel_type_right' => 'nullable|string|max:255',
            'extra' => 'nullable|string|max:2000',
            'side' => 'nullable|string|max:2000',
            'observations' => 'nullable|string|max:1000',
            'back_standing_up_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'back_45_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'back_toes_up_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'from_chaplin_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'from_chaplin_toes_up_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'with_insoles_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'patient_id.required' => 'El paciente es obligatorio.',
            'patient_id.integer' => 'El ID del paciente debe ser un número.',
            'patient_id.exists' => 'El paciente no existe en el sistema.',

            'appointment_date.required' => 'La fecha de atención es obligatoria.',
            'appointment_date.date' => 'Debe ingresar una fecha válida.',

            'shoe_size.required' => 'La talla de zapato es obligatoria.',
            'shoe_size.numeric' => 'La talla debe ser un número.',
            'shoe_size.min' => 'La talla mínima es 1.',
            'shoe_size.max' => 'La talla máxima es 50.',

            'footstep_type_left.required' => 'El tipo de pisada izquierda es obligatorio.',
            'footstep_type_right.required' => 'El tipo de pisada derecha es obligatorio.',

            'foot_type_left.required' => 'El tipo de pie izquierdo es obligatorio.',
            'foot_type_right.required' => 'El tipo de pie derecho es obligatorio.',

            'heel_type_left.required' => 'El tipo de talón izquierdo es obligatorio.',
            'heel_type_right.required' => 'El tipo de talón derecho es obligatorio.',

            'observations.string' => 'Las observaciones deben ser texto.',
            'observations.max' => 'Las observaciones no deben superar los 1000 caracteres.',

            '*.image' => 'El archivo debe ser una imagen válida.',
            '*.mimes' => 'Solo se permiten imágenes con formato jpg, jpeg o png.',
            '*.max' => 'La imagen no debe superar los 2MB.',
        ];
    }
}
