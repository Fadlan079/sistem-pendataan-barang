@extends('layouts.dashboard')
@section('title', 'Detail Kategori')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route(auth()->user()->role . '.category.index') }}" class="shrink-0 inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-border/40 text-muted hover:text-primary hover:bg-surface transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-primary">Informasi Kategori</h1>
                <p class="text-xs md:text-sm text-muted mt-0.5">Detail referensi data kategori.</p>
            </div>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="{{ route(auth()->user()->role . '.category.edit', $category->id) }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-info hover:bg-info/90 text-white font-semibold px-6 py-2.5 rounded-xl transition-all shadow-sm gap-2 text-sm">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl border border-border/40 p-6 md:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center gap-5">
                <div class="shrink-0 w-16 h-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center border border-primary/20">
                    <i class="fa-solid fa-tags text-3xl"></i>
                </div>
                <div class="flex-1">
                    <div class="text-xs font-bold tracking-wider text-muted uppercase mb-1">Nomenklatur Kategori</div>
                    <h2 class="text-2xl font-bold text-text">{{ $category->name }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-border/40 p-6 md:p-8 shadow-sm">
                <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4 flex items-center gap-2 border-b border-border/40 pb-3">
                    <i class="fa-solid fa-align-left"></i>
                    Keterangan
                </h3>
                <div class="text-sm md:text-base text-text leading-relaxed">
                    @if($category->description)
                        <div class="prose prose-sm md:prose-base max-w-none">
                            {!! nl2br(e($category->description)) !!}
                        </div>
                    @else
                        <div class="flex items-center gap-2 text-muted italic bg-surface/50 p-4 rounded-xl border border-border/20">
                            <i class="fa-solid fa-circle-info"></i>
                            Tidak ada deskripsi yang dilampirkan pada kategori ini.
                        </div>
                    @endif
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
                        <div class="text-xs font-bold tracking-wider text-muted uppercase mb-2">ID Basis Data</div>
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-surface border border-border/40 text-sm font-mono text-text">
                            #{{ $category->id }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-border/40 shadow-sm p-6">
                <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4 border-b border-border/40 pb-3">Riwayat Log</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 text-muted"><i class="fa-regular fa-calendar-plus"></i></div>
                        <div>
                            <div class="text-xs font-semibold text-text">Didaftarkan pada</div>
                            <div class="text-xs text-muted mt-0.5">{{ $category->created_at->translatedFormat('d F Y - H:i') }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 text-muted"><i class="fa-regular fa-pen-to-square"></i></div>
                        <div>
                            <div class="text-xs font-semibold text-text">Pembaruan terakhir</div>
                            <div class="text-xs text-muted mt-0.5">{{ $category->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
