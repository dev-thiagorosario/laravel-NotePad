<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Traits\DecryptIdTrait;
use App\Models\Notes;
use Illuminate\Http\RedirectResponse;

class DeleteNoteController extends Controller
{
    use DecryptIdTrait;
    public function deleteNote(string $id): RedirectResponse
    {
        $noteId = $this->decryptId($id);
        if (!$noteId) {
            return redirect()->to('/');
        }

        $note = Notes::find($noteId);
        $sessionUser = session('user');

        if (!$note || !$sessionUser || ($note->user_id !== ($sessionUser['id'] ?? null))) {
            return redirect()->to('/');
        }

        $note->delete();

        return redirect()->to('/');
    }

}
