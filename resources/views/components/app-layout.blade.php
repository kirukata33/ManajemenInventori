<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'InvenTrack') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" x-data="{ sidebarOpen: false, miniSidebar: localStorage.getItem('miniSidebar') === 'true' }" x-init="$watch('miniSidebar', val => localStorage.setItem('miniSidebar', val))" :class="miniSidebar ? 'mini-sidebar-active' : ''" x-cloak>

    <div class="flex h-screen overflow-hidden">

        {{-- ===== MOBILE BACKDROP ===== --}}
        <div x-show="sidebarOpen" x-transition.opacity.duration.300ms
             class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"
             @click="sidebarOpen = false"></div>

        {{-- ===== SIDEBAR ===== --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="app-sidebar fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:z-auto"
               style="background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);">

            {{-- Logo --}}
            <div class="flex items-center h-[72px] px-6 border-b border-white/[0.06] overflow-hidden whitespace-nowrap" :class="miniSidebar ? 'lg:justify-center lg:px-0' : ''">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg transition-all duration-300 group-hover:shadow-indigo-500/30 group-hover:scale-105 shrink-0"
                         style="background: var(--gradient-primary);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div :class="miniSidebar ? 'lg:hidden' : ''" class="transition-opacity duration-300">
                        <span class="text-lg font-extrabold text-white tracking-tight">Inven<span class="text-indigo-400">Track</span></span>
                        <span class="block text-[10px] font-medium text-slate-500 tracking-wider uppercase -mt-0.5">Inventory System</span>
                    </div>
                </a>
                {{-- Close button mobile --}}
                <button @click="sidebarOpen = false" class="ml-auto p-1.5 rounded-lg text-slate-500 hover:text-white hover:bg-white/10 lg:hidden transition-colors shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto overflow-x-hidden sidebar-scroll px-4 py-6 space-y-1.5">

                <p :class="miniSidebar ? 'lg:hidden' : ''" class="px-3 mb-3 text-[10px] font-bold text-slate-600 uppercase tracking-[0.15em] transition-opacity duration-300 whitespace-nowrap">Overview</p>

                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" :class="miniSidebar ? 'lg:justify-center' : ''" :title="miniSidebar ? 'Dashboard' : ''">
                    <span class="link-icon {{ request()->routeIs('dashboard') ? 'bg-indigo-500/20 text-indigo-400' : 'bg-white/5 text-slate-400' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zm-10 9a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1v-5zm10-2a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
                    </span>
                    <span :class="miniSidebar ? 'lg:hidden' : ''" class="whitespace-nowrap transition-opacity duration-300">Dashboard</span>
                </a>

                <a href="{{ route('barang.index') }}" class="sidebar-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" :class="miniSidebar ? 'lg:justify-center' : ''" :title="miniSidebar ? 'Manajemen Barang' : ''">
                    <span class="link-icon {{ request()->routeIs('barang.*') ? 'bg-indigo-500/20 text-indigo-400' : 'bg-white/5 text-slate-400' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </span>
                    <span :class="miniSidebar ? 'lg:hidden' : ''" class="whitespace-nowrap transition-opacity duration-300">Manajemen Barang</span>
                </a>

                <div class="pt-6 pb-2">
                    <p :class="miniSidebar ? 'lg:hidden' : ''" class="px-3 text-[10px] font-bold text-slate-600 uppercase tracking-[0.15em] transition-opacity duration-300 whitespace-nowrap">Transaksi</p>
                    <div :class="miniSidebar ? 'hidden' : 'lg:hidden'" class="hidden lg:block w-8 h-px bg-slate-700/50 mx-auto"></div>
                </div>

                <a href="{{ route('barang-masuk.index') }}" class="sidebar-link {{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}" :class="miniSidebar ? 'lg:justify-center' : ''" :title="miniSidebar ? 'Barang Masuk' : ''">
                    <span class="link-icon {{ request()->routeIs('barang-masuk.*') ? 'bg-emerald-500/20 text-emerald-400' : 'bg-white/5 text-slate-400' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m0 0l-4-4m4 4l4-4M4 20h16"/></svg>
                    </span>
                    <span :class="miniSidebar ? 'lg:hidden' : ''" class="whitespace-nowrap transition-opacity duration-300">Barang Masuk</span>
                    @if(request()->routeIs('barang-masuk.*'))
                    <span :class="miniSidebar ? 'lg:absolute lg:top-2 lg:right-2' : 'ml-auto'" class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    @endif
                </a>

                <a href="{{ route('barang-keluar.index') }}" class="sidebar-link {{ request()->routeIs('barang-keluar.*') ? 'active' : '' }}" :class="miniSidebar ? 'lg:justify-center' : ''" :title="miniSidebar ? 'Barang Keluar' : ''">
                    <span class="link-icon {{ request()->routeIs('barang-keluar.*') ? 'bg-rose-500/20 text-rose-400' : 'bg-white/5 text-slate-400' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m0 0l4 4m-4-4l-4 4M4 4h16"/></svg>
                    </span>
                    <span :class="miniSidebar ? 'lg:hidden' : ''" class="whitespace-nowrap transition-opacity duration-300">Barang Keluar</span>
                    @if(request()->routeIs('barang-keluar.*'))
                    <span :class="miniSidebar ? 'lg:absolute lg:top-2 lg:right-2' : 'ml-auto'" class="w-1.5 h-1.5 rounded-full bg-rose-400 animate-pulse"></span>
                    @endif
                </a>

                @auth
                @if(auth()->user()->isAdmin())
                <div class="pt-6 pb-2">
                    <p :class="miniSidebar ? 'lg:hidden' : ''" class="px-3 text-[10px] font-bold text-slate-600 uppercase tracking-[0.15em] transition-opacity duration-300 whitespace-nowrap">Pengaturan</p>
                    <div :class="miniSidebar ? 'hidden' : 'lg:hidden'" class="hidden lg:block w-8 h-px bg-slate-700/50 mx-auto"></div>
                </div>
                <a href="{{ route('user.index') }}" class="sidebar-link {{ request()->routeIs('user.*') ? 'active' : '' }}" :class="miniSidebar ? 'lg:justify-center' : ''" :title="miniSidebar ? 'Manajemen User' : ''">
                    <span class="link-icon {{ request()->routeIs('user.*') ? 'bg-indigo-500/20 text-indigo-400' : 'bg-white/5 text-slate-400' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                    <span :class="miniSidebar ? 'lg:hidden' : ''" class="whitespace-nowrap transition-opacity duration-300">Manajemen User</span>
                </a>
                @endif
                @endauth
            </nav>

            {{-- User Profile Card --}}
            @auth
            <div class="p-4 border-t border-white/[0.06]" :class="miniSidebar ? 'lg:p-3' : ''">
                <div class="flex items-center gap-3 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] transition-colors cursor-default group overflow-hidden"
                     :class="miniSidebar ? 'lg:justify-center lg:p-2' : 'p-3'">
                    <a href="{{ route('profile.edit') }}" title="Update Profile" class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-lg ring-2 ring-white/10 shrink-0 hover:ring-indigo-400 hover:scale-105 hover:shadow-indigo-500/50 transition-all cursor-pointer"
                         style="background: var(--gradient-primary);">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </a>
                    <div :class="miniSidebar ? 'lg:hidden' : ''" class="flex-1 min-w-0 transition-opacity duration-300">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate capitalize">{{ Auth::user()->role ?? 'User' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" :class="miniSidebar ? 'lg:hidden' : ''">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg text-slate-500 hover:text-rose-400 hover:bg-rose-500/10 transition-all shrink-0" title="Logout">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </aside>

        {{-- ===== MAIN CONTENT AREA ===== --}}
        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300">

            {{-- Top Header --}}
            <header class="flex items-center justify-between h-[72px] px-4 sm:px-8 bg-white/70 backdrop-blur-xl border-b border-slate-200/60 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    {{-- Mobile Toggle --}}
                    <button @click="sidebarOpen = true"
                            class="p-2.5 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 lg:hidden transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    {{-- Desktop Toggle (Mini Sidebar) --}}
                    <button @click="miniSidebar = !miniSidebar"
                            class="hidden lg:block p-2.5 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500/50 group"
                            title="Toggle Sidebar">
                        <svg class="w-5 h-5 transition-transform duration-300" :class="miniSidebar ? '' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    </button>

                    {{-- Page Header --}}
                    @isset($header)
                    <div class="animate-slide-in-left hidden sm:block">
                        {{ $header }}
                    </div>
                    @endisset
                </div>

                <div class="flex items-center gap-3">
                    {{-- Date Display --}}
                    <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-100 text-xs text-slate-500 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ now()->translatedFormat('l, d M Y') }}
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto page-bg relative">
                <div class="p-4 sm:p-6 lg:p-8 max-w-[1400px] mx-auto animate-fade-in-up">
                    @isset($header)
                    <div class="sm:hidden mb-6">
                        {{ $header }}
                    </div>
                    @endisset
                    
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

</body>
</html>