<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Semua role bisa melihat daftar barang
        
        // 1. Ambil value dari input search di URL (?search=...)
        $search = request('search');

        // 2. Query menggunakan when() agar dinamis
        $barangs = Barang::latest()
            ->when($search, function ($query, $search) {
                $query->where('kode_barang', 'like', "%{$search}%")
                      ->orWhere('nama_barang', 'like', "%{$search}%")
                      ->orWhere('kategori', 'like', "%{$search}%");
            })
            ->get();

        // 3. Stok menipis tidak perlu difilter, tetap tampilkan semua sebagai alert
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

        $barang = Barang::create($request->all());

        // Catat sebagai riwayat barang masuk jika stok awal > 0
        if ($barang->stok > 0) {
            \App\Models\BarangMasuk::create([
                'barang_id'     => $barang->id,
                'jumlah'        => $barang->stok,
                'tanggal_masuk' => now()->toDateString(),
                'supplier'      => 'Sistem',
                'keterangan'    => 'Stok Awal (Penambahan Barang Baru)',
            ]);
        }

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
            'satuan'       => 'required|in:pcs,kg,liter,box,rim,lusin,meter,set',
        ]);

        $stokLama = $barang->stok;
        $stokBaru = $request->stok;

        // Catat riwayat jika ada perubahan stok manual
        if ($stokBaru > $stokLama) {
            \App\Models\BarangMasuk::create([
                'barang_id'     => $barang->id,
                'jumlah'        => $stokBaru - $stokLama,
                'tanggal_masuk' => now()->toDateString(),
                'supplier'      => 'Sistem (Edit Manual)',
                'keterangan'    => 'Penyesuaian penambahan stok melalui Edit Barang',
            ]);
        } elseif ($stokBaru < $stokLama) {
            \App\Models\BarangKeluar::create([
                'barang_id'      => $barang->id,
                'jumlah'         => $stokLama - $stokBaru,
                'tanggal_keluar' => now()->toDateString(),
                'tujuan'         => 'Sistem (Edit Manual)',
                'keterangan'     => 'Penyesuaian pengurangan stok melalui Edit Barang',
            ]);
        }

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