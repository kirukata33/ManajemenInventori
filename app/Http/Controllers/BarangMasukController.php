<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        // Semua role (Admin, Operator, Kepala Gudang) boleh melihat daftar barang masuk
        $barangMasuks = BarangMasuk::with('barang')->latest()->get();
        return view('barang-masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        // Proteksi: Hanya Admin & Operator yang bisa mengakses halaman tambah barang masuk
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENAMBAH DATA BARANG MASUK.');
        }

        $barangs = Barang::all();
        return view('barang-masuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        // Proteksi: Hanya Admin & Operator yang bisa menyimpan data barang masuk
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENAMBAH DATA BARANG MASUK.');
        }

        $request->validate([
            'barang_id'     => 'required|exists:barangs,id',
            'jumlah'        => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'supplier'      => 'nullable|string',
            'keterangan'    => 'nullable|string',
        ]);

        BarangMasuk::create($request->all());

        // Update stok barang
        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->route('barang-masuk.index')
                         ->with('success', 'Barang masuk berhasil dicatat!');
    }
}