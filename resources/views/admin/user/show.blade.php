@extends('layouts.dashboard')
@section('title', 'Detail Kredensial Pengguna')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route(auth()->user()->role . '.user.index') }}" class="shrink-0 inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-border/40 text-muted hover:text-primary hover:bg-surface transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-primary">Informasi Kredensial</h1>
                <p class="text-xs md:text-sm text-muted mt-0.5">Tinjauan detail hak akses dan identitas akun.</p>
            </div>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="{{ route(auth()->user()->role . '.user.edit', $user->id) }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-info hover:bg-info/90 text-white font-semibold px-6 py-2.5 rounded-xl transition-all shadow-sm gap-2 text-sm">
                <i class="fa-solid fa-pen-to-square"></i>
                Modifikasi Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl border border-border/40 p-6 md:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="shrink-0 w-20 h-20 rounded-full bg-primary/10 text-primary flex items-center justify-center border-4 border-white shadow-sm overflow-hidden">
                    <span class="text-3xl font-extrabold">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 space-y-1.5">
                    <div class="flex items-center gap-3">
                        <h2 class="text-2xl font-bold text-text">{{ $user->name }}</h2>
                        @php
                            $roleColors = [
                                'admin' => 'bg-primary/10 text-primary border-primary/20',
                                'staff' => 'bg-info/10 text-info border-info/20',
                                'guest' => 'bg-surface border-border/40 text-muted'
                            ];
                            $roleIcons = [
                                'admin' => 'fa-shield-halved',
                                'staff' => 'fa-user-tie',
                                'guest' => 'fa-user'
                            ];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-bold border {{ $roleColors[$user->role] ?? $roleColors['guest'] }}">
                            <i class="fa-solid {{ $roleIcons[$user->role] ?? $roleIcons['guest'] }} text-[10px]"></i>
                            {{ strtoupper($user->role) }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-muted text-sm font-medium">
                        <i class="fa-regular fa-envelope"></i>
                        {{ $user->email }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-border/40 p-6 md:p-8 shadow-sm">
                <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4 flex items-center gap-2 border-b border-border/40 pb-3">
                    <i class="fa-solid fa-id-card-clip"></i>
                    Status Otorisasi
                </h3>
                <div class="text-sm md:text-base text-text leading-relaxed">
                    <p>Akun ini memiliki klasifikasi tingkat <strong class="text-primary">{{ strtoupper($user->role) }}</strong>.</p>
                    <p class="mt-2 text-muted text-sm">
                        @if($user->role === 'admin')
                            Mempunyai otorisasi penuh untuk memodifikasi konfigurasi sistem, mengelola inventaris, serta melakukan tindakan administratif terhadap akun pengguna lain.
                        @else
                            Mempunyai batas otorisasi standar. Hanya dapat mengakses fitur publik atau operasional dasar yang ditentukan oleh sistem tanpa hak modifikasi global.
                        @endif
                    </p>
                </div>
            </div>

        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-2xl border border-border/40 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/40 bg-surface/30">
                    <h3 class="text-sm font-bold tracking-wider text-muted uppercase">Metadata Sistem</h3>
                </div>

                <div class="p-6 space-y-6">
                    <div>
                        <div class="text-xs font-bold tracking-wider text-muted uppercase mb-2">ID Otentikasi</div>
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-surface border border-border/40 text-sm font-mono text-text">
                            UID-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-border/40 shadow-sm p-6">
                <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4 border-b border-border/40 pb-3">Riwayat Kredensial</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 text-muted"><i class="fa-regular fa-calendar-check"></i></div>
                        <div>
                            <div class="text-xs font-semibold text-text">Registrasi Sistem</div>
                            <div class="text-xs text-muted mt-0.5">{{ $user->created_at->translatedFormat('d F Y - H:i') }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 text-muted"><i class="fa-regular fa-pen-to-square"></i></div>
                        <div>
                            <div class="text-xs font-semibold text-text">Modifikasi Terakhir</div>
                            <div class="text-xs text-muted mt-0.5">{{ $user->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
