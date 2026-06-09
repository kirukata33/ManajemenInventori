<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Barang
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($stokMenipis->count() > 0)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>⚠️ Stok Menipis!</strong>
                @foreach($stokMenipis as $item)
                    <span class="block">{{ $item->nama_barang }} — Stok: {{ $item->stok }}</span>
                @endforeach
            </div>
            @endif
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Barang</h3>
                    <a href="{{ route('barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Barang</a>
                </div>
                <table class="w-full text-sm text-left border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Kode</th>
                            <th class="p-3 border">Nama Barang</th>
                            <th class="p-3 border">Kategori</th>
                            <th class="p-3 border">Satuan</th>
                            <th class="p-3 border">Stok</th>
                            <th class="p-3 border">Min. Stok</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                        <tr class="{{ $barang->stok <= $barang->stok_minimum ? 'bg-red-50' : '' }}">
                            <td class="p-3 border">{{ $loop->iteration }}</td>
                            <td class="p-3 border">{{ $barang->kode_barang }}</td>
                            <td class="p-3 border">{{ $barang->nama_barang }}</td>
                            <td class="p-3 border">{{ $barang->kategori }}</td>
                            <td class="p-3 border">{{ $barang->satuan }}</td>
                            <td class="p-3 border font-bold {{ $barang->stok <= $barang->stok_minimum ? 'text-red-600' : 'text-green-600' }}">{{ $barang->stok }}</td>
                            <td class="p-3 border">{{ $barang->stok_minimum }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('barang.edit', $barang) }}" class="bg-yellow-400 text-white px-2 py-1 rounded text-xs">Edit</a>
                                <form action="{{ route('barang.destroy', $barang) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus?')" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="p-3 border text-center text-gray-400">Belum ada barang</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>