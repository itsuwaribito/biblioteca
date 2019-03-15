<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => "required|unique:users,username,$this->id|min:5",
            "name" => "required",
            "apellido_paterno" => "required",
            "apellido_materno" => "required",
            "email" => "required|unique:users,email,$this->id|email",
            "password" => "sometimes|min:6"
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "username.required" => "El nombre de usuario es obligatorio",
            "username.min" => "El nombre de usuario debe contar con almenos 5 caracteres",
            "username.unique" => "El nombre de usuario ya se encuentra en uso",
            "name.required" => "El nombre es obligatorio",
            "apellido_paterno.required" => "El apellido paterno es obligatorio",
            "apellido_materno.required" => "El apellido materno es obligatorio",
            "email.required" => "El correo electronico es obligatorio",
            "email.email" => "El formato del correo electronico no es valido",
            "email.unique" => "El correo electronico ya se encuentra en uso",
            "password.min" => "La contraseña debe contar con almenos 6 caracteres"
        ];
    }
}
