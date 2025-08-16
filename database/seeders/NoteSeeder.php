<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\User;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create(['email' => 'demo@example.com']);
        Note::factory()->count(5)->create(['user_id' => $user->id]);
    }
}
