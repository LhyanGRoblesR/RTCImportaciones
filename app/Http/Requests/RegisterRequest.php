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
        return [
            'email' => 'required|unique:t_users,email',
            'id_document_types' => 'required',
            'document' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'ruc' => 'required',
            'business_name' => 'required',
            'country' => 'required',
            'department' => 'required',
            'province' => 'required',
            'district' => 'required',
            'address' => 'required'
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'id_document_types.required' => 'El tipo de documento es obligatorio.',
            'document.required' => 'El número de documento es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'phone.required' => 'El N° de celular es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
            'password_confirmation.same' => 'La confirmación de la contraseña no coincide.',
            'ruc.required' => 'El RUC es obligatorio.',
            'business_name.required' => 'El nombre de la empresa es obligatorio.',
            'country.required' => 'El país es obligatorio.',
            'department.required' => 'El departamento es obligatorio.',
            'province.required' => 'La provincia es obligatoria.',
            'district.required' => 'El distrito es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
        ];
    }
}
