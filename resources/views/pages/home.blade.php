@extends('layouts.app')

@section('title', 'Sistem Pendataan Barang')

@section('content')

<div class="bg-bg text-text min-h-screen flex flex-col justify-between font-sans selection:bg-primary-accent/25 selection:text-primary">

    <header x-data="{ open: false }" class="bg-surface border-b border-border/40 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between gap-4">
            <a href="/" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                <img src="{{ asset('screen.png') }}" class="w-8 h-8 rounded shadow-sm object-cover" alt="Logo">
                <span class="text-lg font-bold tracking-tight text-primary">Sistem Pendataan Barang</span>
            </a>

            <nav class="hidden md:flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <div class="flex items-center gap-3">
                            <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="text-sm bg-primary text-white hover:bg-primary/90 transition-colors p-2 rounded font-semibold text-secondary hover:text-secondary-light">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-semibold text-danger bg-danger text-white hover:bg-danger/80 transition-colors cursor-pointer p-2 rounded shadow-md">Keluar</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold bg-primary text-white hover:bg-primary/90 transition-colors p-2 rounded">Masuk</a>
                    @endauth
                @endif
            </nav>

            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="text-primary hover:text-secondary focus:outline-none transition-colors cursor-pointer" aria-label="Toggle menu">
                    <i class="fa-solid" :class="open ? 'fa-xmark text-xl' : 'fa-bars text-xl'"></i>
                </button>
            </div>
        </div>

        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-border/20 bg-surface px-6 py-4 shadow-inner"
             style="display: none;">
            <nav class="flex flex-col gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="block text-center text-sm bg-primary text-white hover:bg-primary/90 transition-colors p-2.5 rounded font-semibold text-secondary hover:text-secondary-light">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-center text-sm font-semibold text-danger bg-danger text-white hover:bg-danger/80 transition-colors cursor-pointer p-2.5 rounded shadow-md">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block text-center text-sm font-semibold bg-primary text-white hover:bg-primary/90 transition-colors p-2.5 rounded">Masuk</a>
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-6xl mx-auto px-6 py-12 md:py-20 flex flex-col gap-16 md:gap-24 w-full">
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 flex flex-col gap-6 text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary/10 text-secondary border border-secondary-light/20 text-xs font-semibold w-max">
                    <i class="fa-solid fa-circle-check"></i>
                    Sederhana, Bersih & Terstruktur
                </div>

                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-primary leading-[1.15]">
                    Kelola Data Barang dengan Lebih Mudah
                </h1>

                <p class="text-base md:text-lg text-muted leading-relaxed max-w-lg">
                    Sistem ini membantu mencatat, mengatur, dan memantau data barang secara sederhana dan terstruktur.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 mt-2">
                    @auth
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="inline-flex items-center justify-center bg-secondary hover:bg-secondary-light text-white font-semibold px-6 py-3 rounded-xl transition-all shadow-md shadow-secondary/10 gap-2">
                            <i class="fa-solid fa-table-columns"></i>
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-secondary hover:bg-secondary-light text-white font-semibold px-6 py-3 rounded-xl transition-all shadow-md shadow-secondary/10 gap-2">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Masuk ke Dashboard
                        </a>
                    @endauth

                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-text border border-border/80 font-semibold px-6 py-3 rounded-xl transition-all shadow-sm gap-2">
                        <i class="fa-solid fa-list"></i>
                        Lihat Data Barang
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6 w-full bg-white rounded-2xl border border-border/60 shadow-lg p-6 flex flex-col gap-6 relative overflow-hidden">
                <div class="absolute -right-8 -top-8 w-24 h-24 bg-secondary-light/10 rounded-full blur-xl"></div>
                <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-primary-accent/10 rounded-full blur-xl"></div>

                <div class="flex items-center justify-between border-b border-border/30 pb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-danger"></span>
                        <span class="w-3 h-3 rounded-full bg-warning"></span>
                        <span class="w-3 h-3 rounded-full bg-success"></span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-bg p-4 rounded-xl border border-border/30 flex flex-col gap-1">
                        <span class="text-xs font-medium text-muted">Total Barang</span>
                        <span class="text-2xl font-bold text-primary">{{ $totalProducts }}</span>
                    </div>
                    <div class="bg-bg p-4 rounded-xl border border-border/30 flex flex-col gap-1">
                        <span class="text-xs font-medium text-muted">Total Kategori</span>
                        <span class="text-2xl font-bold text-primary">{{ $totalCategories }}</span>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-primary tracking-wide">Data Barang Terbaru</span>
                    </div>

                    <div class="overflow-hidden border border-border/40 rounded-xl bg-bg">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="bg-surface text-muted border-b border-border/40 font-medium">
                                    <th class="p-3">Kode</th>
                                    <th class="p-3">Nama Barang</th>
                                    <th class="p-3">Kategori</th>
                                    <th class="p-3 text-right">Stok</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border/20">
                                @forelse($recentProducts as $prod)
                                    <tr>
                                        <td class="p-3 font-semibold text-primary">{{ $prod->code }}</td>
                                        <td class="p-3 text-text font-medium">{{ $prod->name }}</td>
                                        <td class="p-3 text-muted">{{ $prod->category->name ?? '-' }}</td>
                                        <td class="p-3 text-right font-semibold {{ $prod->stock < 5 ? 'text-danger' : 'text-success' }}">{{ $prod->stock }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="p-3 font-semibold text-primary">PRD-001</td>
                                        <td class="p-3 text-text font-medium">Mouse Logitech</td>
                                        <td class="p-3 text-muted">Elektronik</td>
                                        <td class="p-3 text-right text-success font-semibold">10</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-semibold text-primary">PRD-002</td>
                                        <td class="p-3 text-text font-medium">Buku Tulis Kiky</td>
                                        <td class="p-3 text-muted">ATK</td>
                                        <td class="p-3 text-right text-success font-semibold">45</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-semibold text-primary">PRD-003</td>
                                        <td class="p-3 text-text font-medium">Kursi Kerja</td>
                                        <td class="p-3 text-muted">Furniture</td>
                                        <td class="p-3 text-right text-danger font-semibold">2</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex flex-col gap-8">
            <div class="flex flex-col gap-2">
                <h2 class="text-2xl font-bold tracking-tight text-primary">Fitur Utama</h2>
                <p class="text-sm text-muted">Kemudahan dalam mengorganisir stok inventaris toko Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-7 bg-white rounded-2xl border border-border/40 p-6 flex flex-col gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center">
                        <i class="fa-solid fa-file-pen text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-primary mb-1">Manajemen Data Barang</h3>
                        <p class="text-sm text-muted leading-relaxed">
                            Mencatat data barang secara sistematis. Anda dapat menambah data baru, memperbarui informasi barang, serta menghapus data yang tidak lagi digunakan melalui form sederhana.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-5 bg-primary text-white rounded-2xl border border-primary-light/20 p-6 flex flex-col gap-4 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 w-24 h-24 bg-secondary-light/10 rounded-full blur-xl group-hover:bg-secondary-light/25 transition-all"></div>
                    <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-secondary-light">
                        <i class="fa-solid fa-tags text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white mb-1">Pengelompokan Kategori</h3>
                        <p class="text-sm text-white/80 leading-relaxed">
                            Kelompokkan barang ke dalam beberapa kategori seperti Elektronik, Alat Tulis Kantor (ATK), atau Furniture untuk pengelompokan yang lebih rapi.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-5 bg-white rounded-2xl border border-border/40 p-6 flex flex-col gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-xl bg-success/15 text-success flex items-center justify-center">
                        <i class="fa-solid fa-clipboard-check text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-primary mb-1">Pemantauan Stok</h3>
                        <p class="text-sm text-muted leading-relaxed">
                            Lihat jumlah persediaan barang yang tersedia secara langsung. Menghindari kelalaian pencatatan stok fisik dan stok sistem.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-7 bg-white rounded-2xl border border-border/40 p-6 flex flex-col gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-xl bg-warning/15 text-warning flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-primary mb-1">Pencarian Data Barang</h3>
                        <p class="text-sm text-muted leading-relaxed">
                            Cari barang berdasarkan nama, kode barang, atau deskripsi dengan cepat. Menghemat waktu petugas gudang dalam mencari informasi barang spesifik.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-white border-t border-border/40 py-8 mt-12">
        <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('screen.png') }}" class="w-6 h-6 rounded object-cover" alt="Logo">
                <span class="text-sm font-semibold tracking-tight text-primary">Sistem Pendataan Barang</span>
            </div>
            <p class="text-xs text-muted">
                &copy; {{ date('Y') }} Sistem Pendataan Barang.
            </p>
        </div>
    </footer>
</div>
@endsection
