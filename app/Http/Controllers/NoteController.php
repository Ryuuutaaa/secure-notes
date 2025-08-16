<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['nullable', 'string'],
        ]);

        $data['user_id'] = Auth::id();
        Note::create($data);

        return redirect()->route('notes.index');
    }

    public function show(Note $note)
    {
        abort_unless($note->user_id === Auth::id(), 403);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        abort_unless($note->user_id === Auth::id(), 403);
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        abort_unless($note->user_id === Auth::id(), 403);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['nullable', 'string'],
        ]);
        $note->update($data);
        return redirect()->route('notes.show', $note);
    }

    public function destroy(Note $note)
    {
        abort_unless($note->user_id === Auth::id(), 403);
        $note->delete();
        return redirect()->route('notes.index');
    }
}
