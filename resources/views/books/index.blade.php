<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Buku</h2>
            <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Tambah Buku</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.alerts')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                                <th class="py-3 px-6 text-left">Judul</th>
                                <th class="py-3 px-6 text-left">ISBN</th>
                                <th class="py-3 px-6 text-left">Penulis</th>
                                <th class="py-3 px-6 text-center">Tahun</th>
                                <th class="py-3 px-6 text-right">Harga</th>
                                <th class="py-3 px-6 text-center">Stok</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse ($books as $book)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6">{{ $book->judul }}</td>
                                    <td class="py-3 px-6">{{ $book->isbn }}</td>
                                    <td class="py-3 px-6">{{ $book->author->nama }}</td>
                                    <td class="py-3 px-6 text-center">{{ $book->tahun_terbit }}</td>
                                    <td class="py-3 px-6 text-right">Rp {{ number_format($book->harga, 2, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-center">{{ $book->stok }}</td>
                                    <td class="py-3 px-6">
                                        <div class="flex items-center justify-center" style="gap: 12px;">
                                            <form action="{{ route('books.borrow', $book) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-600 font-semibold">Pinjam</button>
                                            </form>
                                            <a href="{{ route('books.edit', $book) }}" class="text-blue-500 font-semibold">Edit</a>
                                            <form action="{{ route('books.return', $book) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-purple-600 font-semibold">Kembalikan</button>
                                            </form>
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 font-semibold">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 px-6 text-center text-gray-500">Belum ada data buku.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $books->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>