<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m0 0l-4-4m4 4l4-4M4 20h16"/></svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Barang Masuk</h1>
                <p class="text-xs text-slate-500 mt-0.5">Riwayat semua barang yang masuk</p>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="content-section">
        <div class="content-section-header">
            <h3 class="text-base font-bold text-slate-900">Riwayat Barang Masuk</h3>

            @auth
            @if(auth()->user()->isAdmin() || auth()->user()->isOperator())
                <a href="{{ route('barang-masuk.create') }}" class="btn btn-success">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Catat Masuk
                </a>
            @endif
            @endauth
        </div>

        <div class="overflow-x-auto">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th class="w-12">No</th>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Jumlah</th>
                        <th>Supplier</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangMasuks as $item)
                    <tr>
                        <td class="text-slate-400 font-medium">{{ $loop->iteration }}</td>
                        <td>
                            <span class="text-sm font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->translatedFormat('d M Y') }}</span>
                        </td>
                        <td>
                            <span class="inline-flex items-center px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-mono font-semibold">{{ $item->barang->kode_barang }}</span>
                        </td>
                        <td class="font-semibold text-slate-800">{{ $item->barang->nama_barang }}</td>
                        <td class="text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 text-sm font-bold">+{{ $item->jumlah }}</span>
                        </td>
                        <td class="text-slate-600">{{ $item->supplier }}</td>
                        <td class="text-slate-500 max-w-[200px] truncate">{{ $item->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center mb-4 animate-float">
                                    <svg class="w-8 h-8 text-emerald-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m0 0l-4-4m4 4l4-4M4 20h16"/></svg>
                                </div>
                                <p class="text-slate-500 font-semibold">Belum ada data barang masuk</p>
                                <p class="text-xs text-slate-400 mt-1">Catat barang masuk untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>