<x-app-layout>
    <x-slot name="header">
        <h2>My Notes</h2>
    </x-slot>
    <a href="{{ route('notes.create') }}">+ New Note</a>
    <ul>
        @foreach ($notes as $note)
            <li>
                <a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a>
                — <a href="{{ route('notes.edit', $note) }}">edit</a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
