@extends('laporan.layout')

@section('title', 'Laporan Stok Menipis')

@section('content')
<div class="info-section">
    <table style="width: 100%;">
        <tr>
            <td class="text-left"><strong>Jenis Laporan:</strong> Peringatan Stok Menipis</td>
            <td class="text-right"><strong>Perlu Restock:</strong> {{ count($barangs) }} jenis</td>
        </tr>
    </table>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center;">No</th>
            <th style="width: 15%;">Kode</th>
            <th style="width: 35%;">Nama Barang</th>
            <th style="width: 15%;">Kategori</th>
            <th style="width: 10%; text-align: center;">Stok Saat Ini</th>
            <th style="width: 10%; text-align: center;">Min. Stok</th>
            <th style="width: 10%; text-align: center;">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangs as $index => $barang)
        <tr>
            <td style="text-align: center;">{{ $index + 1 }}</td>
            <td style="font-family: monospace;">{{ $barang->kode_barang }}</td>
            <td><strong>{{ $barang->nama_barang }}</strong></td>
            <td>{{ $barang->kategori }}</td>
            <td style="text-align: center; font-weight: bold; color: #e11d48;">
                {{ $barang->stok }}
            </td>
            <td style="text-align: center;">{{ $barang->stok_minimum }}</td>
            <td style="text-align: center;">
                <span class="badge badge-danger">Kritis</span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada barang dengan stok menipis.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
