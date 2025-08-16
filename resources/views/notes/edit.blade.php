<x-app-layout>
    <x-slot name="header">
        <h2>Edit Note</h2>
    </x-slot>
    <form method="POST" action="{{ route('notes.update', $note) }}">
        @csrf @method('PUT')
        <label>Title</label>
        <input type="text" name="title" value="{{ $note->title }}" required>
        <label>Body</label>
        <textarea name="body">{{ $note->body }}</textarea>
        <button type="submit">Update</button>
    </form>
</x-app-layout>
