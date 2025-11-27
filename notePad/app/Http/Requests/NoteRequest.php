<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text_title' => 'required|string|min:3|max:255',
            'text_note' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'text_title.required' => 'O Titulo da nota é obrigatorio',
            'text_title.min' => 'O Titulo deve ter no minimo :min caracteres',
            'text_title.max' => 'O Titulo deve ter no maximo :max caracteres',

            'text_note.required' => 'O texto da nota é obrigatorio',
            'text_note.max' => 'A nota deve ter no maximo :max caracteres',
            'text_note.min' => 'A nota deve ter no minimo :min caracteres',

        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
