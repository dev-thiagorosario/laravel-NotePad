<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Traits\DecryptIdTrait;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class NoteController extends Controller
{
    use DecryptIdTrait;
    public function editNote($id)
    {
        $id = $this->decryptId($id);
    }
    public function deleteNote($id)
    {
     $id = $this->decryptId($id);
    }
}
