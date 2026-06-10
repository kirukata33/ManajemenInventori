<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        // Semua role (Admin, Operator, Kepala Gudang) boleh melihat daftar barang keluar
        $barangKeluars = BarangKeluar::with('barang')->latest()->get();
        return view('barang-keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        // Proteksi: Hanya Admin & Operator yang bisa mengakses halaman catat barang keluar
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENCATAT BARANG KELUAR.');
        }

        $barangs = Barang::all();
        return view('barang-keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        // Proteksi: Hanya Admin & Operator yang bisa menyimpan data barang keluar
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENCATAT BARANG KELUAR.');
        }

        $request->validate([
            'barang_id'      => 'required|exists:barangs,id',
            'jumlah'         => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'tujuan'         => 'nullable|string',
            'keterangan'     => 'nullable|string',
        ]);

        $barang = Barang::find($request->barang_id);

        // Validasi agar stok tidak minus (sudah ada dan sangat bagus!)
        if ($request->jumlah > $barang->stok) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok ('.$barang->stok.')!'])->withInput();
        }

        BarangKeluar::create($request->all());
        
        // Kurangi stok barang
        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()->route('barang-keluar.index')
                         ->with('success', 'Barang keluar berhasil dicatat!');
    }
}