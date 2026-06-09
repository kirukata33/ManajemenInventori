
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Barang
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('barang.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('kode_barang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('nama_barang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                        <input type="text" name="satuan" value="{{ old('satuan') }}"
                               placeholder="pcs / kg / liter / box"
                               class="w-full border rounded px-3 py-2">
                        @error('satuan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok Awal</label>
                        <input type="number" name="stok" value="{{ old('stok', 0) }}" min="0"
                               class="w-full border rounded px-3 py-2">
                        @error('stok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok Minimum</label>
                        <input type="number" name="stok_minimum" value="{{ old('stok_minimum', 5) }}" min="0"
                               class="w-full border rounded px-3 py-2">
                        @error('stok_minimum')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                            Simpan
                        </button>
                        <a href="{{ route('barang.index') }}"
                           class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>