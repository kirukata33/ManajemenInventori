@extends('laporan.layout')

@section('title', 'Laporan Barang Keluar')

@section('content')
<div class="info-section">
    <table style="width: 100%;">
        <tr>
            <td class="text-left">
                <strong>Periode:</strong> 
                @if($dari && $sampai)
                    {{ \Carbon\Carbon::parse($dari)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($sampai)->translatedFormat('d M Y') }}
                @else
                    Semua Waktu
                @endif
            </td>
            <td class="text-right"><strong>Total Transaksi:</strong> {{ count($barangKeluars) }}</td>
        </tr>
    </table>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center;">No</th>
            <th style="width: 15%;">Tanggal</th>
            <th style="width: 15%;">Kode Brg</th>
            <th style="width: 25%;">Nama Barang</th>
            <th style="width: 10%; text-align: center;">Jumlah</th>
            <th style="width: 15%;">Tujuan</th>
            <th style="width: 15%;">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangKeluars as $index => $item)
        <tr>
            <td style="text-align: center;">{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->translatedFormat('d M Y') }}</td>
            <td style="font-family: monospace;">{{ $item->barang->kode_barang }}</td>
            <td><strong>{{ $item->barang->nama_barang }}</strong></td>
            <td style="text-align: center; font-weight: bold; color: #e11d48;">-{{ $item->jumlah }}</td>
            <td>{{ $item->tujuan }}</td>
            <td>{{ $item->keterangan }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada riwayat barang keluar.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
