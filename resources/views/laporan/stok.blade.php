@extends('laporan.layout')

@section('title', 'Laporan Stok Barang')

@section('content')
<div class="info-section">
    <table style="width: 100%;">
        <tr>
            <td class="text-left"><strong>Jenis Laporan:</strong> Keseluruhan Stok Barang</td>
            <td class="text-right"><strong>Total Barang:</strong> {{ count($barangs) }} jenis</td>
        </tr>
    </table>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center;">No</th>
            <th style="width: 15%;">Kode</th>
            <th style="width: 30%;">Nama Barang</th>
            <th style="width: 15%;">Kategori</th>
            <th style="width: 15%; text-align: center;">Satuan</th>
            <th style="width: 10%; text-align: center;">Stok</th>
            <th style="width: 10%; text-align: center;">Min. Stok</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangs as $index => $barang)
        <tr>
            <td style="text-align: center;">{{ $index + 1 }}</td>
            <td style="font-family: monospace;">{{ $barang->kode_barang }}</td>
            <td><strong>{{ $barang->nama_barang }}</strong></td>
            <td>{{ $barang->kategori }}</td>
            <td style="text-align: center;">{{ $barang->satuan }}</td>
            <td style="text-align: center; font-weight: bold; {{ $barang->stok <= $barang->stok_minimum ? 'color: #e11d48;' : 'color: #059669;' }}">
                {{ $barang->stok }}
            </td>
            <td style="text-align: center; color: #666;">{{ $barang->stok_minimum }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada data barang.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
