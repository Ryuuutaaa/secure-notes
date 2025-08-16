<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 2 user untuk testing
        $user1 = User::create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
        ]);

        // Buat catatan untuk Alice
        Note::create([
            'user_id' => $user1->id,
            'title' => 'Catatan Rahasia Alice',
            'body' => 'Ini adalah catatan pribadi Alice yang tidak boleh dilihat orang lain.'
        ]);

        Note::create([
            'user_id' => $user1->id,
            'title' => 'Password Bank Alice',
            'body' => 'Username: alice123, Password: mySecretBank456'
        ]);

        // Buat catatan untuk Bob
        Note::create([
            'user_id' => $user2->id,
            'title' => 'Catatan Bob',
            'body' => 'Ini catatan Bob yang biasa saja.'
        ]);
    }
}
