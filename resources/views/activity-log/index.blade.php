<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Log Aktivitas</h1>
                <p class="text-xs text-slate-500 mt-0.5">Rekaman semua aktivitas sistem terbaru</p>
            </div>
        </div>
    </x-slot>

    <div class="content-section">
        <div class="content-section-header">
            <h3 class="text-base font-bold text-slate-900">Riwayat Sistem</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th class="w-12">No</th>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="text-slate-400 font-medium">{{ $loop->iteration }}</td>
                        <td>
                            <div class="text-sm font-medium text-slate-700">{{ $log->created_at->translatedFormat('d M Y') }}</div>
                            <div class="text-xs text-slate-400">{{ $log->created_at->translatedFormat('H:i:s') }}</div>
                        </td>
                        <td>
                            @if($log->user)
                                <span class="font-semibold text-slate-800">{{ $log->user->name }}</span>
                                <span class="block text-xs text-slate-500">{{ $log->user->email }}</span>
                            @else
                                <span class="font-semibold text-slate-400 italic">Sistem / Terhapus</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $badgeColor = 'bg-slate-100 text-slate-700';
                                if (str_contains(strtolower($log->action), 'tambah') || str_contains(strtolower($log->action), 'masuk') || str_contains(strtolower($log->action), 'login')) {
                                    $badgeColor = 'bg-emerald-100 text-emerald-700';
                                } elseif (str_contains(strtolower($log->action), 'hapus') || str_contains(strtolower($log->action), 'keluar')) {
                                    $badgeColor = 'bg-rose-100 text-rose-700';
                                } elseif (str_contains(strtolower($log->action), 'ubah')) {
                                    $badgeColor = 'bg-indigo-100 text-indigo-700';
                                }
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $badgeColor }}">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="text-slate-600 text-sm max-w-md">{{ $log->description }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mb-4 animate-float">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="text-slate-500 font-semibold">Belum ada log aktivitas</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
