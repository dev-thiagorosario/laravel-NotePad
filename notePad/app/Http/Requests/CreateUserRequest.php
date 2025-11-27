<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    protected array $dontFlash = ['text_password', 'text_password_confirmation'];

    public function rules(): array
    {
        return [
            'text_username' => 'required|string|min:3|max:255',
            'text_email' => 'required|string|email|max:255|unique:users,email',
            'text_password' => 'required|string|min:6|confirmed',
            'text_password_confirmation' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'text_username.required' => 'O campo Usuário é obrigatório.',
            'text_username.string'   => 'O campo Usuário deve ser um texto válido.',
            'text_username.min'      => 'O campo Usuário deve ter no mínimo :min caracteres.',
            'text_username.max'      => 'O campo Usuário deve ter no máximo :max caracteres.',

            'text_email.required' => 'O campo E-mail é obrigatório.',
            'text_email.string'   => 'O campo E-mail deve ser um texto válido.',
            'text_email.email'    => 'Informe um endereço de e-mail válido.',
            'text_email.max'      => 'O campo E-mail deve ter no máximo :max caracteres.',
            'text_email.unique'   => 'Este endereço de e-mail já está em uso.',

            'text_password.required'  => 'O campo Senha é obrigatório.',
            'text_password.string'    => 'O campo Senha deve ser um texto válido.',
            'text_password.min'       => 'A Senha deve ter no mínimo :min caracteres.',
            'text_password.confirmed' => 'A confirmação da senha não confere.',

            'text_password_confirmation.required' => 'O campo Confirmação de senha é obrigatório.',
            'text_password_confirmation.string'   => 'O campo Confirmação de senha deve ser um texto válido.',
            'text_password_confirmation.min'      => 'A Confirmação de senha deve ter no mínimo :min caracteres.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
