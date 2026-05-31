@extends('layouts.app')

@section('title', 'Verifikasi Email - Sistem Pendataan Barang')

@section('content')
<div class="bg-bg text-text min-h-screen flex flex-col justify-between font-sans selection:bg-primary-accent/25 selection:text-primary">

    <main class="flex-1 max-w-6xl mx-auto px-6 py-12 md:py-20 flex items-center justify-center w-full">
        <div class="w-full max-w-md bg-white rounded-2xl border border-border/60 shadow-lg p-8 flex flex-col gap-6 relative overflow-hidden">

            <div class="absolute -right-8 -top-8 w-24 h-24 bg-secondary-light/10 rounded-full blur-xl"></div>
            <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-primary-accent/10 rounded-full blur-xl"></div>

            <div class="relative z-10 text-center flex flex-col gap-2">
                <h2 class="text-2xl font-bold text-primary tracking-tight">Verifikasi Email</h2>
                <p class="text-xs text-muted">Satu langkah lagi untuk mengaktifkan akun Anda</p>
            </div>

            <div class="relative z-10 text-xs text-muted leading-relaxed">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerimanya, kami dengan senang hati akan mengirimkan yang baru.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="relative z-10 bg-success/10 border border-success/35 text-success rounded-xl p-3.5 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </div>
            @endif

            <div class="relative z-10 flex flex-col gap-3 mt-2">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center bg-secondary hover:bg-secondary-light text-white font-semibold py-2.5 rounded-xl transition-all shadow-md shadow-secondary/10 cursor-pointer text-sm gap-2">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center bg-white hover:bg-slate-50 text-text border border-border/80 font-semibold py-2.5 rounded-xl transition-all shadow-sm cursor-pointer text-sm gap-2">
                        <i class="fa-solid fa-right-from-bracket text-xs"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
