<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Semua role bisa melihat daftar barang
        $barangs = Barang::all();
        $stokMenipis = Barang::whereColumn('stok', '<=', 'stok_minimum')->get();
        return view('barang.index', compact('barangs', 'stokMenipis'));
    }

    public function create()
    {
        // Proteksi: Hanya Admin & Operator yang bisa mengakses halaman tambah
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENAMBAH BARANG.');
        }

        return view('barang.create');
    }

    public function store(Request $request)
    {
        // Proteksi: Hanya Admin & Operator yang bisa menyimpan data baru
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENAMBAH BARANG.');
        }

        $request->validate([
            'kode_barang'  => 'required|unique:barangs',
            'nama_barang'  => 'required',
            'kategori'     => 'required',
            'satuan'       => 'required',
            'stok'         => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
        ]);

        Barang::create($request->all());
        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Barang $barang)
    {
        // Proteksi: Hanya Admin & Operator yang bisa mengakses halaman edit
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENGEDIT BARANG.');
        }

        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        // Proteksi: Hanya Admin & Operator yang bisa mengupdate data
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENGEDIT BARANG.');
        }

        $request->validate([
            'nama_barang'  => 'required',
            'kategori'     => 'required',
            'satuan'       => 'required',
            'stok'         => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
        ]);

        $barang->update($request->all());
        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy(Barang $barang)
    {
        // Proteksi: HANYA Admin yang bisa menghapus data
        if (!auth()->user()->isAdmin()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MENGHAPUS BARANG.');
        }

        $barang->delete();
        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil dihapus!');
    }
}