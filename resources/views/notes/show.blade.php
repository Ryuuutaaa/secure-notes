<!-- SECURE: Escape HTML output -->
<h2 class="text-2xl font-bold mb-4">{{ $note->title }}</h2>
<div class="prose max-w-none">
    {{ nl2br(e($note->body)) }}
</div>

<form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline" onsubmit="return confirm('Yakin hapus?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
        🗑️ Hapus
    </button>
</form>
