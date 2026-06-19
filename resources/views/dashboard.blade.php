<x-app-layout>
<x-slot name='header'>
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: var(--gradient-primary);">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zm-10 9a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1v-5zm10-2a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
            <p class="text-xs text-slate-500 mt-0.5">Selamat datang kembali, {{ explode(' ', Auth::user()->name)[0] }}</p>
        </div>
    </div>
</x-slot>

{{-- ===== STAT CARDS ===== --}}
<div class='grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8 stagger-children'>
    {{-- Total Barang --}}
    <div class='stat-card blue animate-fade-in-up'>
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg" style="background: var(--gradient-info); box-shadow: var(--shadow-glow-primary);">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <span class="badge badge-info">Total</span>
        </div>
        <p class='text-3xl font-extrabold text-slate-900 tracking-tight'>{{ $totalBarang }}</p>
        <p class='text-sm text-slate-500 mt-1 font-medium'>Jenis Barang</p>
    </div>

    {{-- Masuk Hari Ini --}}
    <div class='stat-card green animate-fade-in-up'>
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg" style="background: var(--gradient-success); box-shadow: var(--shadow-glow-success);">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
            </div>
            <span class="badge badge-success">Hari Ini</span>
        </div>
        <p class='text-3xl font-extrabold text-slate-900 tracking-tight'>{{ $masukHariIni }}</p>
        <p class='text-sm text-slate-500 mt-1 font-medium'>Barang Masuk</p>
    </div>

    {{-- Keluar Hari Ini --}}
    <div class='stat-card rose animate-fade-in-up'>
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg" style="background: var(--gradient-danger); box-shadow: var(--shadow-glow-danger);">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m0 0l4 4m-4-4l-4 4"/></svg>
            </div>
            <span class="badge badge-danger">Hari Ini</span>
        </div>
        <p class='text-3xl font-extrabold text-slate-900 tracking-tight'>{{ $keluarHariIni }}</p>
        <p class='text-sm text-slate-500 mt-1 font-medium'>Barang Keluar</p>
    </div>

    {{-- Stok Menipis --}}
    <div class='stat-card amber animate-fade-in-up'>
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg" style="background: var(--gradient-warning); box-shadow: var(--shadow-glow-warning);">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            </div>
            <span class="badge badge-warning">Peringatan</span>
        </div>
        <p class='text-3xl font-extrabold text-slate-900 tracking-tight'>{{ $stokMenipis->count() }}</p>
        <p class='text-sm text-slate-500 mt-1 font-medium'>Stok Menipis</p>
    </div>
</div>

{{-- ===== CHART ===== --}}
<div class="content-section mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
    <div class="content-section-header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <div>
                <h3 class='text-base font-bold text-slate-900'>Statistik Transaksi</h3>
                <p class="text-xs text-slate-500 mt-0.5">6 Bulan Terakhir</p>
            </div>
        </div>
    </div>
    <div class="content-section-body">
        <div class="relative h-80 w-full">
            <canvas id="transaksiChart"></canvas>
        </div>
    </div>
</div>

{{-- ===== STOK MENIPIS & TRANSAKSI TERBARU ===== --}}
<div class='grid grid-cols-1 xl:grid-cols-2 gap-6 stagger-children'>

    {{-- Stok Menipis --}}
    <div class='content-section animate-fade-in-up'>
        <div class="content-section-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
                <div>
                    <h3 class='text-base font-bold text-slate-900'>Stok Menipis</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Barang yang perlu restock</p>
                </div>
            </div>
            @if($stokMenipis->count() > 0)
            <span class="badge badge-danger">{{ $stokMenipis->count() }} item</span>
            @endif
        </div>
        <div class="content-section-body">
            <div class="space-y-3">
                @forelse($stokMenipis as $item)
                <div class='flex items-center justify-between p-3.5 rounded-xl bg-slate-50/80 border border-slate-100 hover:border-amber-200 hover:bg-amber-50/30 transition-all duration-200 group'>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center shadow-sm group-hover:shadow-amber-100 transition-shadow">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <div>
                            <p class='text-sm font-semibold text-slate-800'>{{ $item->nama_barang }}</p>
                            <p class="text-xs text-slate-500 font-medium">{{ $item->kode_barang }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class='badge badge-danger text-xs font-bold'>Stok: {{ $item->stok }}</span>
                        <p class="text-[10px] text-slate-400 mt-1">Min: {{ $item->stok_minimum }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500 mb-4 animate-float">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class='text-slate-500 font-semibold'>Semua stok aman!</p>
                    <p class="text-xs text-slate-400 mt-1">Tidak ada barang yang perlu restock</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class='content-section animate-fade-in-up'>
        <div class="content-section-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class='text-base font-bold text-slate-900'>Transaksi Terbaru</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Aktivitas terakhir</p>
                </div>
            </div>
        </div>
        <div class="content-section-body">
            <div class="space-y-3">
                @forelse($transaksiTerbaru as $t)
                <div class='flex items-center justify-between p-3.5 rounded-xl bg-slate-50/80 border border-slate-100 hover:border-slate-200 transition-all duration-200'>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm {{ $t['warna'] === 'green' ? 'bg-emerald-50 border border-emerald-100' : 'bg-rose-50 border border-rose-100' }}">
                            @if($t['warna'] === 'green')
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
                            @else
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m0 0l4 4m-4-4l-4 4"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class='text-sm font-semibold text-slate-800'>{{ $t["nama"] }}</p>
                            <p class="text-xs text-slate-500">{{ $t["ket"] }}</p>
                        </div>
                    </div>
                    <span class='text-base font-extrabold tracking-tight {{ $t["warna"] === "green" ? "text-emerald-600" : "text-rose-600" }}'>
                        {{ $t["warna"] === "green" ? '+' : '-' }}{{ $t["jumlah"] }}
                    </span>
                </div>
                @empty
                <div class="text-center py-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-slate-50 text-slate-400 mb-4 animate-float">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </div>
                    <p class='text-slate-500 font-semibold'>Belum ada transaksi</p>
                    <p class="text-xs text-slate-400 mt-1">Data akan muncul saat ada aktivitas</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ===== CHART.JS ===== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('transaksiChart').getContext('2d');

    const gradientMasuk = ctx.createLinearGradient(0, 0, 0, 320);
    gradientMasuk.addColorStop(0, 'rgba(16, 185, 129, 0.85)');
    gradientMasuk.addColorStop(1, 'rgba(16, 185, 129, 0.15)');

    const gradientKeluar = ctx.createLinearGradient(0, 0, 0, 320);
    gradientKeluar.addColorStop(0, 'rgba(244, 63, 94, 0.85)');
    gradientKeluar.addColorStop(1, 'rgba(244, 63, 94, 0.15)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {{ Js::from($months) }},
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: {{ Js::from($masukPerBulan) }},
                    backgroundColor: gradientMasuk,
                    borderColor: '#10b981',
                    borderWidth: 0,
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.55,
                    categoryPercentage: 0.7
                },
                {
                    label: 'Barang Keluar',
                    data: {{ Js::from($keluarPerBulan) }},
                    backgroundColor: gradientKeluar,
                    borderColor: '#f43f5e',
                    borderWidth: 0,
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.55,
                    categoryPercentage: 0.7
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        boxWidth: 10,
                        boxHeight: 10,
                        padding: 20,
                        font: { family: "'Inter', sans-serif", weight: '600', size: 12 },
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleFont: { family: "'Inter', sans-serif", size: 12, weight: '500' },
                    bodyFont: { family: "'Inter', sans-serif", size: 14, weight: '700' },
                    padding: { top: 10, bottom: 10, left: 14, right: 14 },
                    cornerRadius: 10,
                    displayColors: true,
                    usePointStyle: true,
                    boxPadding: 6,
                    caretSize: 6
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { font: { family: "'Inter', sans-serif", weight: '500', size: 12 }, color: '#94a3b8', padding: 8 }
                },
                y: {
                    beginAtZero: true,
                    border: { display: false },
                    grid: { color: '#f1f5f9', lineWidth: 1 },
                    ticks: { stepSize: 1, font: { family: "'Inter', sans-serif", weight: '500', size: 12 }, color: '#94a3b8', padding: 8 }
                }
            },
            interaction: { intersect: false, mode: 'index' },
        }
    });
</script>
</x-app-layout>