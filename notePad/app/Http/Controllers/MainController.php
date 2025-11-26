<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $id = session('id');

        $user = User::find($id)->toArray();

        $notes = User::find($id)->notes()->get()->toArray();
    }
}
