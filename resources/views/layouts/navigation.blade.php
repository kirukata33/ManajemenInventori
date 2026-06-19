<aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-72 overflow-y-auto transition-transform duration-300 transform bg-slate-900 lg:translate-x-0 lg:static lg:inset-0 shadow-2xl flex flex-col justify-between border-r border-slate-800">
    <div>
        <div class="flex items-center justify-center mt-8 mb-6">
            <a href="{{ route('dashboard') }}" class="flex items-center group">
                <div class="p-2.5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg shadow-indigo-500/30 group-hover:shadow-indigo-500/50 transition-all duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="ml-3 text-2xl font-extrabold text-white tracking-wide">Invent<span class="text-indigo-400">Manager</span></span>
            </a>
        </div>

        <div class="px-4 mb-4">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Menu Utama</p>
        </div>

        <nav class="px-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('dashboard') ? 'bg-indigo-600/10 text-indigo-400 border border-indigo-500/20 rounded-xl shadow-sm' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl transition-all duration-200 border border-transparent' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="mx-3 font-medium">Dashboard</span>
            </a>

            <a href="{{ route('barang.index') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('barang.*') ? 'bg-indigo-600/10 text-indigo-400 border border-indigo-500/20 rounded-xl shadow-sm' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl transition-all duration-200 border border-transparent' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('barang.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <span class="mx-3 font-medium">Manajemen Barang</span>
            </a>
        </nav>

        <div class="px-4 mt-8 mb-4">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Transaksi</p>
        </div>

        <nav class="px-4 space-y-2">
            <a href="{{ route('barang-masuk.index') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('barang-masuk.*') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-xl shadow-sm' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl transition-all duration-200 border border-transparent' }}">
                <div class="p-1 {{ request()->routeIs('barang-masuk.*') ? 'bg-emerald-500/20 rounded-md' : 'bg-slate-800 rounded-md group-hover:bg-slate-700' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('barang-masuk.*') ? 'text-emerald-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </div>
                <span class="mx-3 font-medium">Barang Masuk</span>
            </a>

            <a href="{{ route('barang-keluar.index') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('barang-keluar.*') ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20 rounded-xl shadow-sm' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl transition-all duration-200 border border-transparent' }}">
                <div class="p-1 {{ request()->routeIs('barang-keluar.*') ? 'bg-rose-500/20 rounded-md' : 'bg-slate-800 rounded-md group-hover:bg-slate-700' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('barang-keluar.*') ? 'text-rose-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </div>
                <span class="mx-3 font-medium">Barang Keluar</span>
            </a>
        </nav>
    </div>

    <div class="px-4 py-6 mt-10">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700/50 p-4 group cursor-pointer hover:border-slate-600 transition-colors">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-500/10 rounded-full blur-xl group-hover:bg-indigo-500/20 transition-all"></div>
            
            <div class="relative flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-lg ring-2 ring-slate-800">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ml-3 flex-1 overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-medium text-slate-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>
