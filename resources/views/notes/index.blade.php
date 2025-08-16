<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">🛡️ Catatan Anda (SECURE)</h2>
                    <a href="{{ route('notes.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        ➕ Tambah Catatan
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($notes as $note)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start mb-2">
                                <!-- SECURE: Escaped HTML output -->
                                <h3 class="font-bold text-lg">{{ $note->title }}</h3>
                                <span class="text-xs text-gray-500">
                                    👤 {{ $note->user->name }}
                                </span>
                            </div>

                            <!-- SECURE: Escaped HTML output -->
                            <p class="text-gray-600 mb-4">{{ Str::limit($note->body, 100) }}</p>

                            <div class="flex space-x-2">
                                <a href="{{ route('notes.show', $note) }}"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('notes.edit', $note) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    ✏️ Edit
                                </a>
                                <form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-gray-500 py-8">
                            Belum ada catatan. <a href="{{ route('notes.create') }}" class="text-blue-500">Buat yang
                                pertama!</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
