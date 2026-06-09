<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluars = BarangKeluar::with('barang')->latest()->get();
        return view('barang-keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('barang-keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'      => 'required|exists:barangs,id',
            'jumlah'         => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'tujuan'         => 'nullable|string',
            'keterangan'     => 'nullable|string',
        ]);

        $barang = Barang::find($request->barang_id);

        if ($request->jumlah > $barang->stok) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok ('.$barang->stok.')!'])->withInput();
        }

        BarangKeluar::create($request->all());
        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()->route('barang-keluar.index')
                         ->with('success', 'Barang keluar berhasil dicatat!');
    }
}