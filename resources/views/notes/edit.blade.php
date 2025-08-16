<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">✏️ Edit Catatan</h1>
                    <a href="{{ route('notes.show', $note) }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        ← Kembali
                    </a>
                </div>

                <form method="POST" action="{{ route('notes.update', $note) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            📝 Judul Catatan
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $note->title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                            📄 Isi Catatan
                        </label>
                        <textarea name="body" id="body" rows="8"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body', $note->body) }}</textarea>
                        @error('body')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                            💾 Update Catatan
                        </button>
                        <a href="{{ route('notes.show', $note) }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
