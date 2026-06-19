@php $VALBARANG = $barang @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('barang.index') }}" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Edit Barang</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ $VALBARANG->kode_barang }} — {{ $VALBARANG->nama_barang }}</p>
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
                <form method="POST" action="{{ route('barang.update', $VALBARANG) }}">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input type="text" value="{{ $VALBARANG->kode_barang }}" class="form-input !bg-slate-50 !text-slate-400 cursor-not-allowed" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang', $VALBARANG->nama_barang) }}" class="form-input" placeholder="Masukkan nama barang">
                            @error('nama_barang') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" id="kategori" class="form-input">
                                <option value="" disabled>-- Pilih Kategori --</option>
                                <option value="Elektronik" {{ old('kategori', $VALBARANG->kategori) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="Pakaian" {{ old('kategori', $VALBARANG->kategori) == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="Makanan" {{ old('kategori', $VALBARANG->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ old('kategori', $VALBARANG->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Alat Tulis" {{ old('kategori', $VALBARANG->kategori) == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                                <option value="Peralatan Kantor" {{ old('kategori', $VALBARANG->kategori) == 'Peralatan Kantor' ? 'selected' : '' }}>Peralatan Kantor</option>
                                <option value="Peralatan Kebersihan" {{ old('kategori', $VALBARANG->kategori) == 'Peralatan Kebersihan' ? 'selected' : '' }}>Peralatan Kebersihan</option>
                                <option value="Lainnya" {{ old('kategori', $VALBARANG->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <select name="satuan" id="satuan" class="form-input">
                                <option value="" disabled>-- Pilih Satuan --</option>
                                <option value="pcs" {{ old('satuan', $VALBARANG->satuan) == 'pcs' ? 'selected' : '' }}>Pcs (Buah)</option>
                                <option value="kg" {{ old('satuan', $VALBARANG->satuan) == 'kg' ? 'selected' : '' }}>Kg (Kilogram)</option>
                                <option value="liter" {{ old('satuan', $VALBARANG->satuan) == 'liter' ? 'selected' : '' }}>Liter</option>
                                <option value="box" {{ old('satuan', $VALBARANG->satuan) == 'box' ? 'selected' : '' }}>Box (Kotak)</option>
                                <option value="rim" {{ old('satuan', $VALBARANG->satuan) == 'rim' ? 'selected' : '' }}>Rim (500 Lembar)</option>
                                <option value="lusin" {{ old('satuan', $VALBARANG->satuan) == 'lusin' ? 'selected' : '' }}>Lusin (12 Buah)</option>
                                <option value="meter" {{ old('satuan', $VALBARANG->satuan) == 'meter' ? 'selected' : '' }}>Meter</option>
                                <option value="set" {{ old('satuan', $VALBARANG->satuan) == 'set' ? 'selected' : '' }}>Set</option>
                            </select>
                            @error('satuan') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $VALBARANG->stok) }}" min="0" class="form-input">
                            @error('stok') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Stok Minimum</label>
                            <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $VALBARANG->stok_minimum) }}" min="0" class="form-input">
                            @error('stok_minimum') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
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
