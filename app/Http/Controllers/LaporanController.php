<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function stokBarang()
    {
        $barangs = Barang::orderBy('kode_barang')->get();

        $pdf = Pdf::loadView('laporan.stok', [
            'barangs' => $barangs,
            'tanggal' => Carbon::now()->translatedFormat('d F Y')
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Stok_Barang_' . Carbon::now()->format('Ymd') . '.pdf');
    }

    public function stokMenipis()
    {
        $barangs = Barang::whereColumn('stok', '<=', 'stok_minimum')
            ->orderBy('stok', 'asc')
            ->get();

        $pdf = Pdf::loadView('laporan.stok-menipis', [
            'barangs' => $barangs,
            'tanggal' => Carbon::now()->translatedFormat('d F Y')
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Stok_Menipis_' . Carbon::now()->format('Ymd') . '.pdf');
    }

    public function barangMasuk(Request $request)
    {
        $query = BarangMasuk::with('barang')->orderBy('tanggal_masuk', 'desc');

        if ($request->has('dari') && $request->has('sampai') && $request->dari != '' && $request->sampai != '') {
            $query->whereBetween('tanggal_masuk', [$request->dari, $request->sampai]);
        }

        $barangMasuks = $query->get();

        $pdf = Pdf::loadView('laporan.barang-masuk', [
            'barangMasuks' => $barangMasuks,
            'tanggal' => Carbon::now()->translatedFormat('d F Y'),
            'dari' => $request->dari,
            'sampai' => $request->sampai
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Barang_Masuk_' . Carbon::now()->format('Ymd') . '.pdf');
    }

    public function barangKeluar(Request $request)
    {
        $query = BarangKeluar::with('barang')->orderBy('tanggal_keluar', 'desc');

        if ($request->has('dari') && $request->has('sampai') && $request->dari != '' && $request->sampai != '') {
            $query->whereBetween('tanggal_keluar', [$request->dari, $request->sampai]);
        }

        $barangKeluars = $query->get();

        $pdf = Pdf::loadView('laporan.barang-keluar', [
            'barangKeluars' => $barangKeluars,
            'tanggal' => Carbon::now()->translatedFormat('d F Y'),
            'dari' => $request->dari,
            'sampai' => $request->sampai
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Barang_Keluar_' . Carbon::now()->format('Ymd') . '.pdf');
    }
}
