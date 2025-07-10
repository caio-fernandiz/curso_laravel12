<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $user = $this->route('user');
        $userId = $user?->id;
        return [
            'name' => 'required',
            'email' => ['required','email',Rule::unique('users', 'email')->ignore($userId),],
            'password' => 'required_if:password,!=,null|min:6'
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => "Informe o seu nome",
            'email.required' => "Informe o seu e-mail",
            'email.email' => "Necessário enviar e-mail válido",
            'email.unique' => "O e-mail já está cadastrado!",
            'password.required_if:password,!=,null' => "Informe uma senha",
            'password.min' => "Senha com no mínimo :min caracteres"
        ];
    }
}
