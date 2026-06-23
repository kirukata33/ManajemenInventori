<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangMasuk::with('barang')->latest();

        if ($request->has('dari') && $request->has('sampai') && $request->dari != '' && $request->sampai != '') {
            $query->whereBetween('tanggal_masuk', [$request->dari, $request->sampai]);
        }

        // Semua role (Admin, Operator, Kepala Gudang) boleh melihat daftar barang masuk
        $barangMasuks = $query->get();
        return view('barang-masuk.index', compact('barangMasuks', 'request'));
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

        \App\Models\ActivityLog::record('Barang Masuk', 'Mencatat barang masuk untuk ' . $barang->nama_barang . ' sebanyak ' . $request->jumlah . ' ' . $barang->satuan);

        return redirect()->route('barang-masuk.index')
                         ->with('success', 'Barang masuk berhasil dicatat!');
    }
}