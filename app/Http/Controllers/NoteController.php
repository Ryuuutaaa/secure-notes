<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // VULNERABLE: Tampilkan SEMUA catatan (bukan hanya milik user)
    public function index()
    {
        $notes = Note::with('user')->latest()->get(); // BAHAYA: Semua note
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $note = Note::create($data);

        return redirect()->route('notes.show', $note)
            ->with('success', 'Catatan berhasil dibuat!');
    }

    // VULNERABLE: Tidak ada pengecekan kepemilikan
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    // VULNERABLE: Tidak ada pengecekan kepemilikan  
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    // VULNERABLE: Tidak ada pengecekan kepemilikan
    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        $note->update($data);
        return redirect()->route('notes.show', $note)
            ->with('success', 'Catatan berhasil diupdate!');
    }

    // VULNERABLE: Tidak ada pengecekan kepemilikan
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')
            ->with('success', 'Catatan berhasil dihapus!');
    }
}
