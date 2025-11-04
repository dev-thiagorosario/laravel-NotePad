<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'text_username'.'required' => 'O campo usuário é obrigatório.',
            'text_username'.'email' => 'O campo usuário deve ser um email válido.',
            'text_password'.'required' => 'O campo senha é obrigatório.',
            'text_password'.'min' => 'O campo senha deve ter no mínimo 6 caracteres.'
        ]
        
        );
    
        $username = $request->input('text_username');
        $password = $request->input('text_password');
        
        $user = User::where('username', $username)-> where('deleted_at', NULL)->first();

        if(!$user){
            return redirect()->back()->withInput()->with('Login error', 'Username ou Senha estão incorretos'); 
        };

        if(!password_verify($password, $user->password)){
            return redirect()->back()->withInput()->with('Login error', 'Username ou Senha estão incorretos');
        }

    
        $user->last_login = date('Y-m-d H-i-s');
        $user->save();

        session([
            'user' =>[
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

    }


    public function logout(){
        session()->forget('user');
        return redirect()->to('/login');
    }

}
