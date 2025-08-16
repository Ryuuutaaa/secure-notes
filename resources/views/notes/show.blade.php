<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">📄 Detail Catatan</h1>
                    <a href="{{ route('notes.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        ← Kembali
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="mb-4">
                        <span class="text-sm text-gray-500">Pemilik: {{ $note->user->name }}</span>
                        <span class="text-sm text-gray-500 ml-4">Dibuat: {{ $note->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- VULNERABLE: Raw HTML output -->
                    <h2 class="text-2xl font-bold mb-4">{!! $note->title !!}</h2>
                    <div class="prose max-w-none">
                        {!! nl2br($note->body) !!}
                    </div>
                </div>

                <div class="flex space-x-4 mt-6">
                    <a href="{{ route('notes.edit', $note) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        ✏️ Edit Catatan
                    </a>
                    <form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline"
                        onsubmit="return confirm('Yakin hapus catatan ini?')">
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            🗑️ Hapus Catatan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
