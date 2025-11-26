<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginSubmit(Request $request){

        $request->validate([
            'text_username' => 'required|email',
            'text_password' => 'required|min:6'
        ],

        [
            'text_username.required' => 'O campo usuário é obrigatório.',
            'text_username.email' => 'O campo usuário deve ser um email válido.',
            'text_password.required' => 'O campo senha é obrigatório.',
            'text_password.min' => 'O campo senha deve ter no mínimo 6 caracteres.'
        ]

        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('email', $username)-> where('deleted_at', NULL)->first();

        if(!$user){
            return redirect()->back()->withInput()->with('loginError', 'Email ou Senha estão incorretos');
        };

        if(!Hash::check($password, $user->password)){
            return redirect()->back()->withInput()->with('loginError', 'Email ou Senha estão incorretos');
        }

        $user->last_login_at = now();
        $user->save();

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
