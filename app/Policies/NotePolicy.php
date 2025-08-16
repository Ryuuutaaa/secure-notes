<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // User bisa lihat daftar catatan mereka sendiri
    }

    public function view(User $user, Note $note): bool
    {
        return $note->user_id === $user->id; // Hanya pemilik yang bisa lihat
    }

    public function create(User $user): bool
    {
        return true; // User bisa buat catatan baru
    }

    public function update(User $user, Note $note): bool
    {
        return $note->user_id === $user->id; // Hanya pemilik yang bisa edit
    }

    public function delete(User $user, Note $note): bool
    {
        return $note->user_id === $user->id; // Hanya pemilik yang bisa hapus
    }
}
