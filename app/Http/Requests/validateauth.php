<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateauth extends FormRequest
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
            'name' =>'required |string | ',
            'email' =>'required | email | unique:users,email',
            'password' => 'required | min:8 ',
            'confirm_password'=>'required | min:8 '
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' =>'Nom invalid',
            'name.string' =>'Nom is not string',
            'email.required' =>'email invalid',
            'password.required' =>'password invalid',
            'confirm_password.required' =>'confirm_password invalid',
            'email.email' =>' Ecrit un email',
            'email.unique' =>'email deja exeist',
            'password.min' =>'Entrer +8 caracters',
            'confirm_password.min' =>'Entrer +8 caracters',
        ];
    }
}
