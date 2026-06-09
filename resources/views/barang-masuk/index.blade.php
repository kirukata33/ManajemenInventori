<x-app-layout>
<x-slot name='header'><h2 class='font-semibold text-xl text-gray-800 leading-tight'>Barang Masuk</h2></x-slot>
<div class='py-6'><div class='max-w-7xl mx-auto sm:px-6 lg:px-8'>
@if(session('success'))
<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4'>{{ session('success') }}</div>
@endif
<div class='bg-white shadow rounded-lg p-6'>
<div class='flex justify-between items-center mb-4'>
<h3 class='text-lg font-semibold'>Riwayat Barang Masuk</h3>
<a href='{{ route("barang-masuk.create") }}' class='bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600'>+ Catat Masuk</a>
</div>
<table class='w-full text-sm text-left border'>
<thead class='bg-gray-100'>
<tr><th class='p-3 border'>No</th><th class='p-3 border'>Tanggal</th><th class='p-3 border'>Kode</th><th class='p-3 border'>Nama Barang</th><th class='p-3 border'>Jumlah</th><th class='p-3 border'>Supplier</th><th class='p-3 border'>Keterangan</th></tr>
</thead>
<tbody>
@forelse($barangMasuks as $item)
<tr><td class='p-3 border'>{{ $loop->iteration }}</td><td class='p-3 border'>{{ $item->tanggal_masuk }}</td><td class='p-3 border'>{{ $item->barang->kode_barang }}</td><td class='p-3 border'>{{ $item->barang->nama_barang }}</td><td class='p-3 border text-green-600 font-bold'>+{{ $item->jumlah }}</td><td class='p-3 border'>{{ $item->supplier }}</td><td class='p-3 border'>{{ $item->keterangan }}</td></tr>
@empty
<tr><td colspan='7' class='p-3 border text-center text-gray-400'>Belum ada data</td></tr>
@endforelse
</tbody></table></div></div></div>
</x-app-layout>
