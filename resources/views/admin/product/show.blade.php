@extends('layouts.dashboard')
@section('title', 'Detail Produk')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div class="flex items-start sm:items-center gap-4">

            <a href="{{ route(auth()->user()->role . '.product.index') }}"
               class="shrink-0 inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-border/40 text-muted hover:text-primary hover:bg-surface transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="min-w-0">
                <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-primary">
                    Informasi Produk
                </h1>
                <p class="text-xs md:text-sm text-muted mt-0.5">
                    Tinjauan komprehensif metrik dan spesifikasi.
                </p>
            </div>

        </div>

        <div class="flex w-full sm:w-auto">
            <a href="{{ route(auth()->user()->role . '.product.edit', $product->id) }}"
               class="w-full sm:w-auto inline-flex items-center justify-center bg-info hover:bg-info/90 text-white font-semibold px-5 sm:px-6 py-2.5 rounded-xl transition-all shadow-sm gap-2 text-sm">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Data
            </a>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl border border-border/40 p-5 sm:p-6 lg:p-8 shadow-sm flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-5">

                <div class="shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center border border-primary/20">
                    <i class="fa-solid fa-box-open text-2xl sm:text-3xl"></i>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="text-xs font-bold tracking-wider text-muted uppercase mb-1">
                        Kode Identifikasi
                    </div>

                    <h2 class="text-xl sm:text-2xl font-bold text-text mb-1 break-words">
                        {{ $product->name }}
                    </h2>

                    <p class="text-sm font-mono text-primary bg-primary/5 px-3 py-1 rounded-lg inline-block border border-primary/10 max-w-full overflow-x-auto">
                        {{ $product->code }}
                    </p>
                </div>

            </div>


            <div class="bg-white rounded-2xl border border-border/40 p-5 sm:p-6 lg:p-8 shadow-sm">

                <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4 flex items-center gap-2 border-b border-border/40 pb-3">
                    <i class="fa-solid fa-align-left"></i>
                    Deskripsi Spesifik
                </h3>

                <div class="text-sm md:text-base text-text leading-relaxed">
                    @if($product->description)
                        <div class="prose prose-sm md:prose-base max-w-none break-words">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @else
                        <div class="flex items-center gap-2 text-muted italic bg-surface/50 p-4 rounded-xl border border-border/20">
                            <i class="fa-solid fa-circle-info"></i>
                            Tidak ada deskripsi yang dilampirkan pada produk ini.
                        </div>
                    @endif
                </div>

            </div>

        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-2xl border border-border/40 shadow-sm overflow-hidden">

                <div class="p-5 sm:p-6 border-b border-border/40 bg-surface/30">
                    <h3 class="text-sm font-bold tracking-wider text-muted uppercase">
                        Metrik Sistem
                    </h3>
                </div>

                <div class="p-5 sm:p-6 space-y-6">

                    <div>
                        <div class="text-xs font-bold tracking-wider text-muted uppercase mb-1">
                            Nilai Moneter
                        </div>
                        <div class="text-xl sm:text-2xl font-extrabold text-primary break-words">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="pt-4 border-t border-border/40">
                        <div class="text-xs font-bold tracking-wider text-muted uppercase mb-2">
                            Kategori Sistem
                        </div>

                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-surface border border-border/40 text-sm font-medium text-text max-w-full">
                            <i class="fa-solid fa-tag text-muted"></i>
                            <span class="truncate">
                                {{ $product->category->name ?? 'Tidak Terkategori' }}
                            </span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-border/40">

                        <div class="text-xs font-bold tracking-wider text-muted uppercase mb-2 flex items-center justify-between">
                            <span>Ketersediaan Inventaris</span>
                            <i class="fa-solid fa-warehouse"></i>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                            @php
                                $stockPercentage = min(100, ($product->stock / 50) * 100);
                                $stockColor = $product->stock < 5 ? 'bg-danger' : 'bg-success';
                            @endphp

                            <div class="flex-1 bg-surface h-2.5 rounded-full overflow-hidden border border-border/20">
                                <div class="h-full {{ $stockColor }} rounded-full"
                                     style="width: {{ $stockPercentage }}%"></div>
                            </div>

                            <span class="text-sm font-bold px-3 py-1 rounded-md border w-fit
                                {{ $product->stock < 5 ? 'bg-danger/10 text-danger border-danger/20' : 'bg-success/10 text-success border-success/20' }}">
                                {{ $product->stock }} Unit
                            </span>

                        </div>

                        @if($product->stock < 5)
                            <p class="text-xs text-danger mt-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                Peringatan: Stok menipis.
                            </p>
                        @endif

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl border border-border/40 shadow-sm p-5 sm:p-6">

                <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4 border-b border-border/40 pb-3">
                    Riwayat Log
                </h3>

                <div class="space-y-4">

                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 text-muted">
                            <i class="fa-regular fa-calendar-plus"></i>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-text">Didaftarkan pada</div>
                            <div class="text-xs text-muted mt-0.5">
                                {{ $product->created_at->translatedFormat('d F Y - H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 text-muted">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-text">Pembaruan terakhir</div>
                            <div class="text-xs text-muted mt-0.5">
                                {{ $product->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection
