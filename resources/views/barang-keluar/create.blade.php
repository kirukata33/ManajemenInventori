<x-app-layout>
<x-slot name='header'><h2 class='font-semibold text-xl text-gray-800 leading-tight'>Catat Barang Keluar</h2></x-slot>
<div class='py-6'><div class='max-w-2xl mx-auto sm:px-6 lg:px-8'><div class='bg-white shadow rounded-lg p-6'>
<form method='POST' action='{{ route("barang-keluar.store") }}'>
@csrf
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Pilih Barang</label>
<select name='barang_id' class='w-full border rounded px-3 py-2'>
<option value=''>-- Pilih Barang --</option>
@foreach($barangs as $barang)
<option value='{{ $barang->id }}'>{{ $barang->kode_barang }} - {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})</option>
@endforeach
</select></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Jumlah</label>
<input type='number' name='jumlah' min='1' value='1' class='w-full border rounded px-3 py-2'>
@error('jumlah')<p class='text-red-500 text-xs mt-1'>{{ $message }}</p>@enderror
</div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Tanggal Keluar</label>
<input type='date' name='tanggal_keluar' value='{{ date("Y-m-d") }}' class='w-full border rounded px-3 py-2'></div>
<div class='mb-4'><label class='block text-sm font-medium mb-1'>Tujuan</label>
<input type='text' name='tujuan' class='w-full border rounded px-3 py-2' placeholder='Tujuan pengiriman'></div>
<div class='mb-6'><label class='block text-sm font-medium mb-1'>Keterangan</label>
<textarea name='keterangan' class='w-full border rounded px-3 py-2' rows='3'></textarea></div>
<div class='flex gap-3'>
<button type='submit' class='bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600'>Simpan</button>
<a href='{{ route("barang-keluar.index") }}' class='bg-gray-300 text-gray-700 px-6 py-2 rounded'>Batal</a>
</div></form></div></div></div>
</x-app-layout>
