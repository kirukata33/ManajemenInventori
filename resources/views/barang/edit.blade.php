@php $b = $barang @endphp
<x-app-layout>
<x-slot name='header'><h2 class='font-semibold text-xl text-gray-800 leading-tight'>Edit Barang</h2></x-slot>
<div class='py-6'><div class='max-w-2xl mx-auto sm:px-6 lg:px-8'><div class='bg-white shadow rounded-lg p-6'>
<form method='POST' action='{{ route("barang.update", $barang) }}'>
@csrf @method('PUT')
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Kode Barang</label>
<input type='text' value='{{ $barang->kode_barang }}' class='w-full border rounded px-3 py-2 bg-gray-100' disabled></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Nama Barang</label>
<input type='text' name='nama_barang' value='{{ old("nama_barang", $barang->nama_barang) }}' class='w-full border rounded px-3 py-2'></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Kategori</label>
<input type='text' name='kategori' value='{{ old("kategori", $barang->kategori) }}' class='w-full border rounded px-3 py-2'></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Satuan</label>
<input type='text' name='satuan' value='{{ old("satuan", $barang->satuan) }}' class='w-full border rounded px-3 py-2'></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Stok</label>
<input type='number' name='stok' value='{{ old("stok", $barang->stok) }}' class='w-full border rounded px-3 py-2'></div>
<div class='mb-6'><label class='block text-sm font-medium mb-1'>Stok Minimum</label>
<input type='number' name='stok_minimum' value='{{ old("stok_minimum", $barang->stok_minimum) }}' class='w-full border rounded px-3 py-2'></div>
<div class='flex gap-3'>
<button type='submit' class='bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600'>Update</button>
<a href='{{ route("barang.index") }}' class='bg-gray-300 text-gray-700 px-6 py-2 rounded'>Batal</a>
</div></form></div></div></div>
</x-app-layout>
