<x-app-layout>
<x-slot name='header'><h2 class='font-semibold text-xl text-gray-800 leading-tight'>Catat Barang Masuk</h2></x-slot>
<div class='py-6'><div class='max-w-2xl mx-auto sm:px-6 lg:px-8'><div class='bg-white shadow rounded-lg p-6'>
<form method='POST' action='{{ route("barang-masuk.store") }}'>
@csrf
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Pilih Barang</label>
<select name='barang_id' class='w-full border rounded px-3 py-2'>
<option value=''>-- Pilih Barang --</option>
@foreach($barangs as $barang)
<option value='{{ $barang->id }}'>{{ $barang->kode_barang }} - {{ $barang->nama_barang }}</option>
@endforeach
</select></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Jumlah</label>
<input type='number' name='jumlah' min='1' value='1' class='w-full border rounded px-3 py-2'></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Tanggal Masuk</label>
<input type='date' name='tanggal_masuk' value='{{ date("Y-m-d") }}' class='w-full border rounded px-3 py-2'></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Supplier</label>
<input type='text' name='supplier' class='w-full border rounded px-3 py-2' placeholder='Nama supplier'></div>
<div class='mb-6'><label class='block text-sm font-medium mb-1'>Keterangan</label>
<textarea name='keterangan' class='w-full border rounded px-3 py-2' rows='3'></textarea></div>
<div class='flex gap-3'>
<button type='submit' class='bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600'>Simpan</button>
<a href='{{ route("barang-masuk.index") }}' class='bg-gray-300 text-gray-700 px-6 py-2 rounded'>Batal</a>
</div></form></div></div></div>
</x-app-layout>
