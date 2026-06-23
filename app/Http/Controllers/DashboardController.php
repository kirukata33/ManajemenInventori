<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang     = Barang::count();
        $masukHariIni    = BarangMasuk::whereDate('tanggal_masuk', today())->sum('jumlah');
        $keluarHariIni   = BarangKeluar::whereDate('tanggal_keluar', today())->sum('jumlah');
        $stokMenipis     = Barang::whereColumn('stok', '<', 'stok_minimum')->get();
        
        $transaksiTerbaru = collect(
            BarangMasuk::with('barang')->latest()->take(3)->get()->map(fn($i) => [
                'nama' => $i->barang->nama_barang,
                'jumlah' => '+'.$i->jumlah,
                'warna' => 'green',
                'ket' => 'masuk dari '.($i->supplier ?? '-'),
                'created_at' => $i->created_at // Ditambahkan agar sortByDesc berfungsi
            ])->merge(
            BarangKeluar::with('barang')->latest()->take(3)->get()->map(fn($i) => [
                'nama' => $i->barang->nama_barang,
                'jumlah' => '-'.$i->jumlah,
                'warna' => 'red',
                'ket' => 'keluar ke '.($i->tujuan ?? '-'),
                'created_at' => $i->created_at // Ditambahkan agar sortByDesc berfungsi
            ]))
        )->sortByDesc('created_at')->take(5);

        // === DATA UNTUK GRAFIK (6 BULAN TERAKHIR) ===
        $months = collect([]);
        $masukPerBulan = collect([]);
        $keluarPerBulan = collect([]);

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months->push($date->format('M Y')); // Contoh: Oct 2023
            
            $masukPerBulan->push(
                BarangMasuk::whereYear('tanggal_masuk', $date->year)
                           ->whereMonth('tanggal_masuk', $date->month)
                           ->sum('jumlah')
            );
            
            $keluarPerBulan->push(
                BarangKeluar::whereYear('tanggal_keluar', $date->year)
                            ->whereMonth('tanggal_keluar', $date->month)
                            ->sum('jumlah')
            );
        }

        return view('dashboard', compact(
            'totalBarang', 'masukHariIni', 'keluarHariIni',
            'stokMenipis', 'transaksiTerbaru',
            'months', 'masukPerBulan', 'keluarPerBulan'
        ));
    }
}