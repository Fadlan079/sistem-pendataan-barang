@extends('layouts.app')

@section('title', 'Masuk - Sistem Pendataan Barang')

@section('content')
<div class="bg-bg text-text min-h-screen flex flex-col justify-between font-sans selection:bg-primary-accent/25 selection:text-primary">

    <main class="flex-1 max-w-6xl mx-auto px-6 py-12 md:py-20 flex items-center justify-center w-full">
        <div class="w-full max-w-md bg-white rounded-2xl border border-border/60 shadow-lg p-8 flex flex-col gap-6 relative overflow-hidden">
            <div class="absolute -right-8 -top-8 w-24 h-24 bg-secondary-light/10 rounded-full blur-xl"></div>
            <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-primary-accent/10 rounded-full blur-xl"></div>

            <div class="relative z-10 text-center flex flex-col gap-2">
                <h2 class="text-2xl font-bold text-primary tracking-tight">Selamat Datang Kembali</h2>
                <p class="text-xs text-muted">Masuk untuk mengelola data barang inventaris Anda</p>
            </div>

            @if (session('status'))
                <div class="relative z-10 bg-success/10 border border-success/35 text-success rounded-xl p-3.5 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="relative z-10 flex flex-col gap-4">
                @csrf
                <div>
                    <label for="email" class="block font-semibold text-xs text-primary uppercase tracking-wide mb-1.5">Email</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-envelope absolute left-3.5 text-muted text-sm"></i>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
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
                    <label for="password" class="block font-semibold text-xs text-primary uppercase tracking-wide mb-1.5">Password</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-lock absolute left-3.5 text-muted text-sm"></i>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
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

                <div class="flex items-center justify-between text-xs mt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-border/85 text-secondary focus:ring-secondary w-4 h-4 bg-bg cursor-pointer">
                        <span class="ms-2 font-medium text-text-variant">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-semibold text-secondary hover:text-secondary-light transition-colors">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full inline-flex items-center justify-center bg-secondary hover:bg-secondary-light text-white font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-secondary/10 cursor-pointer text-sm gap-2 mt-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Masuk
                </button>

                <a href="/" class="w-full inline-flex items-center justify-center bg-bg hover:bg-border/80 text-text font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-secondary/10 cursor-pointer text-sm gap-2 mt-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
            </form>
        </div>
    </main>
</div>
@endsection
