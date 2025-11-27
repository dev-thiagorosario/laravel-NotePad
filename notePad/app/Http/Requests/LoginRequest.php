<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected array $dontFlash = ['text_password'];

    public function rules(): array
    {
        return [
            'text_username' => ['required', 'email', 'string', 'max:255'],
            'text_password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'text_username.required' => 'O campo usuário é obrigatório.',
            'text_username.email'    => 'O campo usuário deve ser um email válido.',
            'text_password.required' => 'O campo senha é obrigatório.',
            'text_password.min'      => 'O campo senha deve ter no mínimo 6 caracteres.',
        ];
    }

    public function getUsername(): string
    {
        return (string) $this->input('text_username');
    }

    public function getPassword(): string
    {
        return (string) $this->input('text_password');
    }

    public function authorize(): bool
    {
        return true;
    }
}
