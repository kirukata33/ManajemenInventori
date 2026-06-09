<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('barang')->latest()->get();
        return view('barang-masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('barang-masuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'     => 'required|exists:barangs,id',
            'jumlah'        => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'supplier'      => 'nullable|string',
            'keterangan'    => 'nullable|string',
        ]);

        BarangMasuk::create($request->all());

        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->route('barang-masuk.index')
                         ->with('success', 'Barang masuk berhasil dicatat!');
    }
}