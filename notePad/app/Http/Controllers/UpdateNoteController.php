<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Traits\DecryptIdTrait;
use App\Models\Notes;

class UpdateNoteController extends Controller
{
    use DecryptIdTrait;
    public function updateNote($id)
    {
        $id = $this->decryptId($id);

        $note = Notes::find($id);

        if (!$note || $note->user_id != session('user')['id']){
            return redirect()->to('/');
        }

        return view('edit_note', ['note' => $note]);
    }

    public function updateNoteSubmit(NoteRequest $request)
    {
        if (!$request->note_id) {
            return redirect()
                ->to('/');
        }

        $id = $this->decryptId($request->note_id);

        $note = Notes::find($id);

        if (!$note || $note->user_id != session('user')['id']) {
            return redirect()->to('/');
        }

        $note->update([
            'title' => $request->text_title,
            'content' => $request->text_note,
        ]);
        return redirect()->to('/');
    }
}
