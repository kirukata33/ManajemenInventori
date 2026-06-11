<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('barang.index') }}" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Tambah Barang</h1>
                <p class="text-xs text-slate-500 mt-0.5">Tambahkan barang baru ke inventori</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="content-section">
            <div class="content-section-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: var(--gradient-primary);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Detail Barang</h3>
                </div>
            </div>
            <div class="content-section-body">
                <form method="POST" action="{{ route('barang.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" class="form-input" placeholder="Contoh: BRG001">
                            @error('kode_barang') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-input" placeholder="Masukkan nama barang">
                            @error('nama_barang') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="kategori" value="{{ old('kategori') }}" class="form-input" placeholder="Contoh: Elektronik">
                            @error('kategori') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <select name="satuan" id="satuan" class="form-input">
                                <option value="" disabled selected>-- Pilih Satuan --</option>
                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs (Buah)</option>
                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg (Kilogram)</option>
                                <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                                <option value="box" {{ old('satuan') == 'box' ? 'selected' : '' }}>Box (Kotak)</option>
                                <option value="rim" {{ old('satuan') == 'rim' ? 'selected' : '' }}>Rim (500 Lembar)</option>
                                <option value="lusin" {{ old('satuan') == 'lusin' ? 'selected' : '' }}>Lusin (12 Buah)</option>
                                <option value="meter" {{ old('satuan') == 'meter' ? 'selected' : '' }}>Meter</option>
                                <option value="set" {{ old('satuan') == 'set' ? 'selected' : '' }}>Set</option>
                            </select>
                            @error('satuan') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Stok Awal</label>
                            <input type="number" name="stok" value="{{ old('stok', 0) }}" min="0" class="form-input">
                            @error('stok') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Stok Minimum</label>
                            <input type="number" name="stok_minimum" value="{{ old('stok_minimum', 5) }}" min="0" class="form-input">
                            @error('stok_minimum') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Simpan Barang
                        </button>
                        <a href="{{ route('barang.index') }}" class="btn btn-ghost">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>