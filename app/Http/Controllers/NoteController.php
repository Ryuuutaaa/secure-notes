<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // SECURE: Hanya tampilkan catatan milik user yang login
    public function index()
    {
        $this->authorize('viewAny', Note::class);

        $notes = Note::where('user_id', Auth::id())
            ->with('user')
            ->latest()
            ->get();

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $this->authorize('create', Note::class);
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Note::class);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $note = Note::create($data);

        return redirect()->route('notes.show', $note)
            ->with('success', 'Catatan berhasil dibuat!');
    }

    // SECURE: Cek kepemilikan sebelum tampilkan
    public function show(Note $note)
    {
        $this->authorize('view', $note);
        return view('notes.show', compact('note'));
    }

    // SECURE: Cek kepemilikan sebelum edit
    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        return view('notes.edit', compact('note'));
    }

    // SECURE: Cek kepemilikan sebelum update
    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        $note->update($data);
        return redirect()->route('notes.show', $note)
            ->with('success', 'Catatan berhasil diupdate!');
    }

    // SECURE: Cek kepemilikan sebelum hapus
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();
        return redirect()->route('notes.index')
            ->with('success', 'Catatan berhasil dihapus!');
    }
}
