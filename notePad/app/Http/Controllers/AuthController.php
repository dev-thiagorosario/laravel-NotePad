<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class AuthController extends Controller
{
    public function __construct(private readonly LoginService $loginService)
    {}

    public function login(){
        return view('login');
    }

    public function loginSubmit(LoginRequest $request){
        $user = $this->loginService->authenticate(
            $request->getUsername(),
            $request->getPassword(),
        );

        session()->regenerate();
        session([
            'user' =>[
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        return redirect()->to('/');

    }

    public function logout(){
        session()->forget('user');
        return redirect()->to('/login');
    }

}
