<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // Opsional: jika mau otomatis authorize semua method resource,
    // aktifkan baris ini lalu hapus pemanggilan $this->authorize(...) di tiap method.
    // public function __construct()
    // {
    //     $this->authorizeResource(Note::class, 'note'); // 'note' harus sama dengan nama parameter Route Model Binding
    // }

    public function index()
    {
        // Data hanya milik user yang login (mencegah bocor di daftar)
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        // Opsional: $this->authorize('create', Note::class);
        return view('notes.create');
    }

    public function store(Request $request)
    {
        // Opsional: $this->authorize('create', Note::class);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['nullable', 'string'],
        ]);

        $data['user_id'] = Auth::id();
        $note = Note::create($data);

        return redirect()->route('notes.show', $note);
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['nullable', 'string'],
        ]);

        $note->update($data);
        return redirect()->route('notes.show', $note);
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();
        return redirect()->route('notes.index');
    }
}
