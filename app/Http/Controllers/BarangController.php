<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $stokMenipis = Barang::whereColumn('stok', '<=', 'stok_minimum')->get();
        return view('barang.index', compact('barangs', 'stokMenipis'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
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
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
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
        $barang->delete();
        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil dihapus!');
    }
}