<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultingOfficeRequest extends FormRequest
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
        return [


            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:consulting_offices,email,' . $id,
            'phone' => 'sometimes|string|max:20',
            'page_web' => 'sometimes|string|max:255',
            'city_id' => 'sometimes|required|integer|exists:cities,id',
            'country_id' => 'sometimes|required|integer|exists:countries,id',
            'department_id' => 'sometimes|required|integer|exists:departments,id',
            'address' => 'sometimes|required|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return (new StoreConsultingOfficeRequest)->messages(); // reutiliza los mensajes
    }
}