<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Buat Akun Baru</h2>
        <p class="text-sm text-slate-500 mt-1.5">Daftar untuk mulai mengelola inventori Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group mb-5">
            <label for="name">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Masukkan nama Anda" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div class="form-group mb-5">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="nama@email.com" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="form-group mb-5">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="form-input" placeholder="••••••••" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group mb-6">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <button type="submit" class="btn btn-primary w-full justify-center py-3 text-base">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Daftar Sekarang
        </button>

        <div class="text-center mt-6 pt-6 border-t border-slate-100">
            <span class="text-sm text-slate-500">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold ml-1 transition-colors">
                Masuk di sini
            </a>
        </div>
    </form>
</x-guest-layout>
