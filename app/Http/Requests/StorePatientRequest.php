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
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'type_document' => 'required|string',
                'number_document' => 'required|string|unique:patients',
                'date_of_birth' => 'required|date',
                'email' => 'required|email|unique:patients',
                'cellphone' => 'required|string',
            ];
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {

            $rules = [
                'name' => 'sometimes|required|string',
                'last_name' => 'sometimes|required|string',
                'type_document' => 'sometimes|required|string',
                'number_document' => 'sometimes|required|string|unique:patients,number_document,' . $id,
                'date_of_birth' => 'sometimes|required|date',
                'email' => 'sometimes|required|email|unique:patients,email,' . $id,
                'cellphone' => 'sometimes|required|string'
            ];
        }

        return $rules;
    }
}
