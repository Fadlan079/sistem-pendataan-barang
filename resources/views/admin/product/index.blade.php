@extends('layouts.dashboard')
@section('title', 'Kelola Produk')

@section('content')
<div class="p-6 md:p-8 space-y-8 min-h-screen selection:bg-primary-accent/25 selection:text-primary font-sans text-text">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-primary">
                Kelola Produk
            </h1>
            <p class="text-sm text-muted mt-1">
                Manajemen data produk sistem pendataan barang
            </p>
        </div>

        <a href="{{ route(auth()->user()->role . '.product.create') }}" class="inline-flex items-center justify-center bg-secondary hover:bg-secondary-light text-white font-semibold px-5 py-2.5 rounded-xl transition-all shadow-md shadow-secondary/10 gap-2 text-sm w-max">
            <i class="fa-solid fa-plus"></i>
            Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-border/40 p-5 shadow-sm">
        <form method="GET" action="{{ route(auth()->user()->role . '.product.index') }}" class="flex flex-col md:flex-row gap-4 items-center w-full">

            <div class="relative w-full md:w-1/2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama atau kode produk..."
                       class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-secondary/30 focus:border-secondary transition-all text-sm bg-bg text-text">
            </div>

            <div class="relative w-full md:w-1/3">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <select name="category_id"
                        class="w-full pl-11 pr-10 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-secondary/30 focus:border-secondary transition-all text-sm bg-bg text-text appearance-none cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-muted">
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </div>
            </div>

            <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-primary hover:bg-primary/90 text-white font-semibold rounded-xl transition-all shadow-sm flex items-center justify-center gap-2 text-sm">
                <i class="fa-solid fa-filter"></i>
                Filter
            </button>

            @if(request()->has('search') || request()->has('category_id'))
                <a href="{{ route(auth()->user()->role . '.product.index') }}" class="w-full md:w-auto px-4 py-2.5 bg-bg hover:bg-border/30 text-muted font-semibold rounded-xl transition-all border border-border/40 flex items-center justify-center text-sm" title="Reset Filter">
                    <i class="fa-solid fa-rotate-right"></i>
                </a>
            @endif

        </form>
    </div>

    <div class="bg-white rounded-2xl border border-border/40 shadow-sm overflow-hidden flex flex-col">

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">

                <thead>
                    <tr class="bg-surface text-muted border-b border-border/40 font-medium">
                        <th class="p-4 whitespace-nowrap">Kode</th>
                        <th class="p-4 whitespace-nowrap">Nama Produk</th>
                        <th class="p-4 whitespace-nowrap">Kategori</th>
                        <th class="p-4 whitespace-nowrap">Harga</th>
                        <th class="p-4 text-center whitespace-nowrap">Stok</th>
                        <th class="p-4 text-right whitespace-nowrap w-36">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border/20">
                    @forelse ($products as $product)
                        <tr class="hover:bg-card-hover transition-colors group">

                            <td class="p-4 font-semibold text-primary">
                                {{ $product->code }}
                            </td>

                            <td class="p-4 text-text font-medium">
                                {{ $product->name }}
                            </td>

                            <td class="p-4 text-muted">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-bg border border-border/40 text-xs">
                                    <i class="fa-solid fa-tag text-muted/70"></i>
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>

                            <td class="p-4 text-text font-medium">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td class="p-4 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold rounded-full border
                                    {{ $product->stock < 5
                                        ? 'bg-danger/10 text-danger border-danger/20'
                                        : 'bg-success/10 text-success border-success/20' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>

                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{ route(auth()->user()->role . '.product.show', $product->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary-light/10 text-primary-light hover:bg-primary-light/20 transition-colors border border-primary-light/20" title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{ route(auth()->user()->role . '.product.edit', $product->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-info/10 text-info hover:bg-info/20 transition-colors border border-info/20" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route(auth()->user()->role . '.product.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Peringatan: Aksi ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-danger/10 text-danger hover:bg-danger/20 transition-colors border border-danger/20" title="Hapus">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12">
                                <div class="flex flex-col items-center justify-center gap-3 text-center">
                                    <div class="w-16 h-16 rounded-full bg-bg flex items-center justify-center text-muted/50 border border-border/40">
                                        <i class="fa-solid fa-box-open text-2xl"></i>
                                    </div>
                                    <p class="text-muted font-medium">Tidak ada data produk yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="border-t border-border/40 p-4 bg-surface/30">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-muted">
                <div>
                    Menampilkan <span class="font-semibold text-primary">{{ $products->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-primary">{{ $products->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-primary">{{ $products->total() }}</span> data
                </div>

                @if ($products->hasPages())
                <nav aria-label="Pagination" class="inline-flex -space-x-px rounded-xl shadow-sm bg-white border border-border/40">

                    @if ($products->onFirstPage())
                        <span class="inline-flex items-center justify-center px-3 py-2 text-muted bg-surface/50 rounded-l-xl border-r border-border/40 cursor-not-allowed">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="inline-flex items-center justify-center px-3 py-2 text-primary hover:bg-card-hover transition-colors rounded-l-xl border-r border-border/40 focus:outline-none focus:ring-2 focus:ring-secondary/30 z-10 relative">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </a>
                    @endif

                    <div class="hidden sm:flex">
                        @foreach ($products->linkCollection() as $link)
                            @if (!$loop->first && !$loop->last)
                                @if (!$link['url'])
                                    <span class="inline-flex items-center justify-center px-4 py-2 text-muted border-r border-border/40">
                                        {{ $link['label'] }}
                                    </span>
                                @elseif ($link['active'])
                                    <span class="inline-flex items-center justify-center px-4 py-2 text-white bg-primary font-semibold border-r border-border/40 cursor-default">
                                        {{ $link['label'] }}
                                    </span>
                                @else
                                    <a href="{{ $link['url'] }}" class="inline-flex items-center justify-center px-4 py-2 text-text hover:bg-card-hover transition-colors border-r border-border/40 focus:outline-none focus:ring-2 focus:ring-secondary/30 z-10 relative">
                                        {{ $link['label'] }}
                                    </a>
                                @endif
                            @endif
                        @endforeach
                    </div>

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="inline-flex items-center justify-center px-3 py-2 text-primary hover:bg-card-hover transition-colors rounded-r-xl focus:outline-none focus:ring-2 focus:ring-secondary/30 z-10 relative">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span class="inline-flex items-center justify-center px-3 py-2 text-muted bg-surface/50 rounded-r-xl cursor-not-allowed">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </span>
                    @endif

                </nav>
                @endif
            </div>
        </div>

    </div>

</div>
@endsection
