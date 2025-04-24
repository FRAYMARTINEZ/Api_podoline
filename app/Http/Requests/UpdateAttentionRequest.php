<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttentionRequest extends FormRequest
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
            'patient_id' => 'sometimes|integer|exists:patients,id',
            'appointment_date' => 'sometimes|date',
            'shoe_size' => 'sometimes|numeric|min:1|max:50',
            'footstep_type_left' => 'sometimes|string|max:255',
            'footstep_type_right' => 'sometimes|string|max:255',
            'foot_type_left' => 'sometimes|string|max:255',
            'foot_type_right' => 'sometimes|string|max:255',
            'heel_type_left' => 'sometimes|string|max:255',
            'heel_type_right' => 'sometimes|string|max:255',
            'extra' => 'sometimes|string|max:255',
            'side' => 'sometimes|string|max:255',
            'observations' => 'sometimes|string|max:1000',
            'back_standing_up_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'back_45_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'back_toes_up_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'from_chaplin_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'from_chaplin_toes_up_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'with_insoles_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return (new StoreAttentionRequest)->messages(); // reutiliza los mensajes
    }
}
