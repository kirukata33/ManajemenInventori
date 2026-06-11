@php $b = $barang @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('barang.index') }}" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Edit Barang</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ $barang->kode_barang }} — {{ $barang->nama_barang }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="content-section">
            <div class="content-section-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: var(--gradient-warning);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Detail Barang</h3>
                </div>
            </div>
            <div class="content-section-body">
                <form method="POST" action="{{ route('barang.update', $barang) }}">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input type="text" value="{{ $barang->kode_barang }}" class="form-input !bg-slate-50 !text-slate-400 cursor-not-allowed" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="kategori" value="{{ old('kategori', $barang->kategori) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <select name="satuan" id="satuan" class="form-input">
                                <option value="" disabled>-- Pilih Satuan --</option>
                                <option value="pcs" {{ old('satuan', $barang->satuan) == 'pcs' ? 'selected' : '' }}>Pcs (Buah)</option>
                                <option value="kg" {{ old('satuan', $barang->satuan) == 'kg' ? 'selected' : '' }}>Kg (Kilogram)</option>
                                <option value="liter" {{ old('satuan', $barang->satuan) == 'liter' ? 'selected' : '' }}>Liter</option>
                                <option value="box" {{ old('satuan', $barang->satuan) == 'box' ? 'selected' : '' }}>Box (Kotak)</option>
                                <option value="rim" {{ old('satuan', $barang->satuan) == 'rim' ? 'selected' : '' }}>Rim (500 Lembar)</option>
                                <option value="lusin" {{ old('satuan', $barang->satuan) == 'lusin' ? 'selected' : '' }}>Lusin (12 Buah)</option>
                                <option value="meter" {{ old('satuan', $barang->satuan) == 'meter' ? 'selected' : '' }}>Meter</option>
                                <option value="set" {{ old('satuan', $barang->satuan) == 'set' ? 'selected' : '' }}>Set</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Stok Minimum</label>
                            <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $barang->stok_minimum) }}" class="form-input">
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <button type="submit" class="btn btn-warning">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Update Barang
                        </button>
                        <a href="{{ route('barang.index') }}" class="btn btn-ghost">Batal</a>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
