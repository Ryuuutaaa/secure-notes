<x-app-layout>
    <x-slot name="header">
        <h2>Create Note</h2>
    </x-slot>
    <form method="POST" action="{{ route('notes.store') }}" class="space-y-6">
        @csrf <!-- Tambahkan CSRF token -->
        <label>Title</label>
        <input type="text" name="title" required>
        <label>Body</label>
        <textarea name="body"></textarea>
        <button type="submit">Save</button>
    </form>
</x-app-layout>
