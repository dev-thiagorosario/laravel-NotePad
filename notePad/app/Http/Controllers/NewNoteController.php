<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Notes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NewNoteController extends Controller
{
    public function newNote(): View
    {
        return view('new_note');
    }

    public function newNoteSubmit(NoteRequest $request): RedirectResponse
    {
        $sessionUser = session('user');
        if (!$sessionUser || empty($sessionUser['id'])) {
            return redirect()
                ->with('error', 'Sessão expirada. Faça login novamente');
        }

        $userId = $sessionUser['id'];
        if (!$userId) {
            return redirect('/')
                ->with('error', 'Não foi possivel identificar o usuario');
        }

        Notes::create([
            'user_id' => $userId,
            'title' => $request->text_title,
            'content' => $request->text_note,
        ]);

        return redirect()->to('/');
    }
}
