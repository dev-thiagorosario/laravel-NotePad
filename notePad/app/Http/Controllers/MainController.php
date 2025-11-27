<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $sessionUser = session('user');

        if (!is_array($sessionUser) || empty($sessionUser['id'])) {
            session()->forget('user');

            return redirect()->route('login');
        }

        $user = User::find($sessionUser['id']);

        if (!$user) {
            session()->forget('user');

            return redirect()->route('login');
        }

        $userData = $user->toArray();

        $notes = $user->notes()->get()->toArray();

        return view('home', compact('userData', 'notes'));
    }
}
