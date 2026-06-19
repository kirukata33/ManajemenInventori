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

    <div x-data="{ showModal: false, barang: {} }">
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
                        <td class="font-semibold">
                            <button type="button" @click="barang = {{ json_encode($item->barang) }}; showModal = true" class="text-indigo-600 hover:text-indigo-800 hover:underline focus:outline-none text-left transition-colors">
                                {{ $item->barang->nama_barang }}
                            </button>
                        </td>
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

        <!-- Detail Modal -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="showModal" x-transition.opacity class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" @click="showModal = false"></div>

                <div x-show="showModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative inline-block w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl sm:my-8 sm:align-middle">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900">Detail Barang</h3>
                        <button @click="showModal = false" class="text-slate-400 hover:text-slate-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="mt-4 space-y-4">
                        <div>
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Kode Barang</span>
                            <span class="block mt-1 text-base font-bold text-slate-800" x-text="barang.kode_barang"></span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Barang</span>
                            <span class="block mt-1 text-base font-medium text-slate-800" x-text="barang.nama_barang"></span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</span>
                                <span class="block mt-1 text-sm font-medium text-slate-700" x-text="barang.kategori"></span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Satuan</span>
                                <span class="block mt-1 text-sm font-medium text-slate-700" x-text="barang.satuan"></span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Stok Saat Ini</span>
                                <span class="block mt-1 text-lg font-bold text-indigo-600" x-text="barang.stok"></span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Batas Minimum</span>
                                <span class="block mt-1 text-lg font-bold text-rose-500" x-text="barang.stok_minimum"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end">
                        <button @click="showModal = false" class="btn btn-ghost">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>