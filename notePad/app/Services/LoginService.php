<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function authenticate(string $email, string $password): User
    {
        $user = User::query()
            ->where('email', $email)
            ->whereNull('deleted_at')
            ->first();

        if (!$user || !Hash::check($password, (string) $user->password)) {
            throw ValidationException::withMessages([
                'text_username' => ['Email ou senha estão incorretos.'],
            ]);
        }

        $user->last_login_at = now();
        $user->save();

        return $user;
    }
}
