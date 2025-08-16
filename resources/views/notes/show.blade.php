<x-app-layout>
    <x-slot name="header">
        <h2>Note Detail</h2>
    </x-slot>
    <h3>{{ $note->title }}</h3>
    <p>{{ $note->body }}</p>
    <form method="POST" action="{{ route('notes.destroy', $note) }}">
        @csrf @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</x-app-layout>
