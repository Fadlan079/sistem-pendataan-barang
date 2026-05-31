@extends('layouts.dashboard')
@section('title', 'Modifikasi Pengguna')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="flex items-center gap-4">
        <a href="{{ route(auth()->user()->role . '.user.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-border/40 text-muted hover:text-primary hover:bg-surface transition-colors shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-primary">Modifikasi Akun</h1>
            <p class="text-xs md:text-sm text-muted mt-0.5">Memperbarui kredensial dan hak otorisasi pengguna.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-border/40 p-6 md:p-8 shadow-sm max-w-3xl">
        <form action="{{ route(auth()->user()->role . '.user.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-text">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('name') border-danger/50 @enderror">
                @error('name') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-text">Alamat Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('email') border-danger/50 @enderror">
                @error('email') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="text-sm font-semibold text-text">Kata Sandi Akses</label>
                <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah sandi"
                       class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('password') border-danger/50 @enderror">
                <p class="text-[11px] text-muted"><i class="fa-solid fa-circle-info mr-1"></i>Sistem akan mempertahankan kata sandi lama jika form ini dibiarkan kosong.</p>
                @error('password') <p class="text-xs text-danger font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="role" class="text-sm font-semibold text-text">Tingkat Hak Akses <span class="text-danger">*</span></label>
                <select name="role" id="role" required class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text appearance-none @error('role') border-danger/50 @enderror">
                    <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Administrator (Akses Penuh)</option>
                    <option value="staff" {{ (old('role', $user->role) == 'staff') ? 'selected' : '' }}>Staff (Operasional Harian)</option>
                    <option value="guest" {{ (old('role', $user->role) == 'guest') ? 'selected' : '' }}>Guest (Akses Baca Terbatas)</option>
                </select>
                @error('role') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-border/40">
                <a href="{{ route(auth()->user()->role . '.user.index') }}" class="px-6 py-2.5 text-sm font-semibold text-text bg-surface border border-border/40 hover:bg-card-hover rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-info hover:bg-info/90 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-check-double"></i>
                    Perbarui Kredensial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
