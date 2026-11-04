<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Penulis</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @include('components.alerts')

                    <form action="{{ route('authors.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" id="email" name="email" value="{{ old('email') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                            <textarea id="bio" name="bio" rows="4"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">{{ old('bio') }}</textarea>
                        </div>

                        <div class="flex items-center" style="gap: 12px;">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                            <a href="{{ route('authors.index') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>