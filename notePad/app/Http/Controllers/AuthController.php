<?php

namespace App\Http\Controllers;

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

    

        $usernamoe = $request->input('text_username');
        $password = $request->input('text_password');

    }


    public function logout(){

    }

}
