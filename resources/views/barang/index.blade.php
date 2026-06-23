<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Manajemen Barang</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola semua data barang inventori</p>
            </div>
        </div>
    </x-slot>

    {{-- ALERT STOK MENIPIS --}}
    @if($stokMenipis->count() > 0)
    <div class="alert alert-warning flex justify-between items-start">
        <div class="flex gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            <div>
                <p class="font-bold">Stok Menipis!</p>
                @foreach($stokMenipis as $item)
                    <span class="block text-sm">{{ $item->nama_barang }} — Stok: {{ $item->stok }}</span>
                @endforeach
            </div>
        </div>
        <a href="{{ route('laporan.stok-menipis') }}" target="_blank" class="btn bg-white text-amber-600 hover:bg-amber-50 border border-amber-200 shadow-sm !py-1.5 !px-3 text-xs whitespace-nowrap mt-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Export PDF
        </a>
    </div>
    @endif

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div class="alert alert-success">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="content-section">
        {{-- HEADER --}}
        <div class="content-section-header">
            <h3 class="text-base font-bold text-slate-900">Daftar Barang</h3>

            <div class="flex flex-wrap items-center gap-3">
                {{-- SEARCH --}}
                <form action="{{ route('barang.index') }}" method="GET" class="flex">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari kode, nama, kategori..."
                               class="form-input pl-10 pr-4 py-2.5 w-full sm:w-72 text-sm !rounded-r-none">
                    </div>
                    <button type="submit" class="btn btn-primary !rounded-l-none !px-4 !shadow-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </form>

                @if(request('search'))
                    <a href="{{ route('barang.index') }}" class="btn btn-ghost text-xs gap-1.5 !py-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reset
                    </a>
                @endif

                <a href="{{ route('laporan.stok') }}" target="_blank" class="btn bg-emerald-50 text-emerald-600 hover:bg-emerald-100 border border-emerald-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export PDF Stok
                </a>

                @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isOperator())
                    <a href="{{ route('barang.create') }}" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Barang
                    </a>
                @endif
                @endauth
            </div>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th class="w-12">No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Min. Stok</th>
                        @auth
                        @if(!auth()->user()->isKepalaGudang())
                        <th class="text-center">Aksi</th>
                        @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $barang)
                    <tr class="{{ $barang->stok <= $barang->stok_minimum ? 'bg-rose-50/40' : '' }}">
                        <td class="text-slate-400 font-medium">{{ $loop->iteration }}</td>
                        <td>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-mono font-semibold">
                                {{ $barang->kode_barang }}
                            </span>
                        </td>
                        <td class="font-semibold text-slate-800">{{ $barang->nama_barang }}</td>
                        <td><span class="badge badge-info">{{ $barang->kategori }}</span></td>
                        <td class="text-slate-500">{{ $barang->satuan }}</td>
                        <td class="text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-sm font-bold
                                {{ $barang->stok <= $barang->stok_minimum ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $barang->stok }}
                            </span>
                        </td>
                        <td class="text-center text-slate-400 font-medium">{{ $barang->stok_minimum }}</td>

                        @auth
                        @if(!auth()->user()->isKepalaGudang())
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if(auth()->user()->isAdmin() || auth()->user()->isOperator())
                                <a href="{{ route('barang.edit', $barang) }}" class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                @endif

                                @if(auth()->user()->isAdmin())
                                <form action="{{ route('barang.destroy', $barang) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus barang ini?')" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                        @endif
                        @endauth
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mb-4 animate-float">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <p class="text-slate-500 font-semibold">
                                    @if(request('search'))
                                        Pencarian "{{ request('search') }}" tidak ditemukan
                                    @else
                                        Belum ada data barang
                                    @endif
                                </p>
                                <p class="text-xs text-slate-400 mt-1">Tambahkan barang untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>