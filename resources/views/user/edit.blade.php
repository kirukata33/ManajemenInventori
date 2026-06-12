<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user.index') }}" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Edit User</h1>
                <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi akun pengguna</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="content-section">
            <div class="content-section-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: var(--gradient-primary);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Detail User</h3>
                </div>
            </div>
            <div class="content-section-body">
                <form method="POST" action="{{ route('user.update', $user) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="form-group sm:col-span-2">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" placeholder="Masukkan nama lengkap">
                            @error('name') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="form-group sm:col-span-2">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" placeholder="Masukkan alamat email">
                            @error('email') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label>Password Baru (Opsional)</label>
                            <input type="password" name="password" class="form-input" placeholder="Kosongkan jika tidak diubah">
                            @error('password') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password baru">
                        </div>

                        <div class="form-group sm:col-span-2">
                            <label>Role</label>
                            <select name="role" class="form-input">
                                <option value="" disabled>-- Pilih Role --</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>Operator</option>
                                <option value="kepala_gudang" {{ old('role', $user->role) == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
                            </select>
                            @error('role') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
