@extends('layouts.app')

@section('title', 'Atur Ulang Password - Sistem Pendataan Barang')

@section('content')
<div class="bg-bg text-text min-h-screen flex flex-col justify-between font-sans selection:bg-primary-accent/25 selection:text-primary">
    <main class="flex-1 max-w-6xl mx-auto px-6 py-12 md:py-20 flex items-center justify-center w-full">
        <div class="w-full max-w-md bg-white rounded-2xl border border-border/60 shadow-lg p-8 flex flex-col gap-6 relative overflow-hidden">
            <div class="absolute -right-8 -top-8 w-24 h-24 bg-secondary-light/10 rounded-full blur-xl"></div>
            <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-primary-accent/10 rounded-full blur-xl"></div>

            <div class="relative z-10 text-center flex flex-col gap-2">
                <h2 class="text-2xl font-bold text-primary tracking-tight">Atur Ulang Password</h2>
                <p class="text-xs text-muted">Buat password baru yang aman untuk akun Anda</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="relative z-10 flex flex-col gap-4">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    <label for="email" class="block font-semibold text-xs text-primary uppercase tracking-wide mb-1.5">Email</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-envelope absolute left-3.5 text-muted text-sm"></i>
                        <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                            class="w-full pl-10 pr-4 py-2.5 bg-bg border border-border/80 rounded-xl text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all text-text"
                            placeholder="nama@email.com" />
                    </div>
                    @error('email')
                        <span class="text-xs text-danger font-medium mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block font-semibold text-xs text-primary uppercase tracking-wide mb-1.5">Password Baru</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-lock absolute left-3.5 text-muted text-sm"></i>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="w-full pl-10 pr-4 py-2.5 bg-bg border border-border/80 rounded-xl text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all text-text"
                            placeholder="••••••••" />
                    </div>
                    @error('password')
                        <span class="text-xs text-danger font-medium mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block font-semibold text-xs text-primary uppercase tracking-wide mb-1.5">Konfirmasi Password Baru</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-lock-keyhole absolute left-3.5 text-muted text-sm"></i>
                        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                            class="w-full pl-10 pr-4 py-2.5 bg-bg border border-border/80 rounded-xl text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all text-text"
                            placeholder="••••••••" />
                    </div>
                    @error('password_confirmation')
                        <span class="text-xs text-danger font-medium mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="w-full inline-flex items-center justify-center bg-secondary hover:bg-secondary-light text-white font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-secondary/10 cursor-pointer text-sm gap-2 mt-2">
                    <i class="fa-solid fa-key"></i>
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </main>
</div>
@endsection
