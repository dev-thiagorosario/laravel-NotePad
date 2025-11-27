<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Controller
{
    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'username' => $validated['text_username'],
            'email'    => $validated['text_email'],
            'password' => Hash::make($validated['text_password']),
        ]);

        $token = $user->generateApiToken();

        return response()->json(
            [
                'ok'      => true,
                'message' => 'Usuário criado com sucesso.',
                'user'    => $user,
                'token'   => $token,
            ],
            201
        );
    }
}
