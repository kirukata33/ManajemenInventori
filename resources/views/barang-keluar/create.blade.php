<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('barang-keluar.index') }}" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Catat Barang Keluar</h1>
                <p class="text-xs text-slate-500 mt-0.5">Tambahkan catatan barang keluar baru</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="content-section">
            <div class="content-section-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: var(--gradient-danger);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m0 0l4 4m-4-4l-4 4"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Detail Barang Keluar</h3>
                </div>
            </div>
            <div class="content-section-body">
                <form method="POST" action="{{ route('barang-keluar.store') }}">
                    @csrf
                    <div class="space-y-5">
                        <div class="form-group">
                            <label>Pilih Barang</label>
                            <select name="barang_id" class="form-input">
                                <option value="">— Pilih Barang —</option>
                                @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->kode_barang }} — {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" min="1" value="1" class="form-input">
                                @error('jumlah') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="date" name="tanggal_keluar" value="{{ date('Y-m-d') }}" class="form-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" name="tujuan" class="form-input" placeholder="Tujuan pengiriman">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-input" rows="3" placeholder="Keterangan tambahan (opsional)"></textarea>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <button type="submit" class="btn btn-danger">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Simpan
                        </button>
                        <a href="{{ route('barang-keluar.index') }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
