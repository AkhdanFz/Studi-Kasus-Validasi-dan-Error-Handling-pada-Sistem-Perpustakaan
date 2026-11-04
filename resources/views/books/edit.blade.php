<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @include('components.alerts')

                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul', $book->judul) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                            <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                            <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" step="0.01" id="harga" name="harga" value="{{ old('harga', $book->harga) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" id="stok" name="stok" value="{{ old('stok', $book->stok) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="author_id" class="block text-sm font-medium text-gray-700">Penulis</label>
                            <select id="author_id" name="author_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="">-- Pilih Penulis --</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                        {{ $author->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center" style="gap: 12px;">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>