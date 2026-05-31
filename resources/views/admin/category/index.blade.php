@extends('layouts.dashboard')
@section('title', 'Kelola Kategori')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-primary">Manajemen Kategori</h1>
            <p class="text-xs md:text-sm text-muted mt-0.5">Kelola klasifikasi sistem dan pengelompokan data.</p>
        </div>
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="{{ route(auth()->user()->role . '.category.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-secondary hover:bg-primary/90 text-white font-semibold px-6 py-2.5 rounded-xl transition-all shadow-sm gap-2 text-sm">
                <i class="fa-solid fa-plus"></i>
                Tambah Kategori
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-border/40 p-4 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
        <form action="{{ route(auth()->user()->role . '.category.index') }}" method="GET" class="w-full md:w-1/3 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi..."
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </div>
            @if(request('search'))
                <a href="{{ route(auth()->user()->role . '.category.index') }}" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-muted hover:text-danger">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-border/40 shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface/50 border-b border-border/40 text-xs uppercase tracking-wider text-muted">
                        <th class="px-6 py-4 font-bold w-16 text-center">No</th>
                        <th class="px-6 py-4 font-bold w-1/3">Nama Kategori</th>
                        <th class="px-6 py-4 font-bold hidden md:table-cell">Deskripsi</th>
                        <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/20 text-sm">
                    @forelse ($categories as $index => $category)
                        <tr class="hover:bg-surface/30 transition-colors">
                            <td class="px-6 py-4 text-center font-medium text-muted">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-text">{{ $category->name }}</div>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell text-muted truncate max-w-xs">
                                {{ $category->description ?: 'Tidak ada deskripsi' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route(auth()->user()->role . '.category.show', $category->id) }}" class="w-8 h-8 rounded-lg bg-info/10 text-info flex items-center justify-center hover:bg-info hover:text-white transition-all" title="Detail">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route(auth()->user()->role . '.category.edit', $category->id) }}" class="w-8 h-8 rounded-lg bg-warning/10 text-warning flex items-center justify-center hover:bg-warning hover:text-white transition-all" title="Edit">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <form action="{{ route(auth()->user()->role . '.category.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Data terkait mungkin akan terpengaruh.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-danger/10 text-danger flex items-center justify-center hover:bg-danger hover:text-white transition-all" title="Hapus">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-muted">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-solid fa-folder-open text-4xl text-muted/50 mb-2"></i>
                                    <p class="font-medium text-base">Tidak ada data kategori ditemukan.</p>
                                    <p class="text-xs">Silakan ubah kata kunci pencarian atau tambah data baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($categories->hasPages())
            <div class="p-4 border-t border-border/40 flex justify-center bg-surface/30">
                <nav aria-label="Pagination" class="inline-flex -space-x-px rounded-xl shadow-sm bg-white border border-border/40">
                    @if ($categories->onFirstPage())
                        <span class="inline-flex items-center justify-center px-3 py-2 text-muted bg-surface/50 rounded-l-xl border-r border-border/40 cursor-not-allowed">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </span>
                    @else
                        <a href="{{ $categories->previousPageUrl() }}" class="inline-flex items-center justify-center px-3 py-2 text-primary hover:bg-card-hover transition-colors rounded-l-xl border-r border-border/40 focus:outline-none z-10">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </a>
                    @endif

                    <div class="hidden sm:flex">
                        @foreach ($categories->linkCollection() as $link)
                            @if (!$loop->first && !$loop->last)
                                @if (!$link['url'])
                                    <span class="inline-flex items-center justify-center px-4 py-2 text-muted border-r border-border/40">{{ $link['label'] }}</span>
                                @elseif ($link['active'])
                                    <span class="inline-flex items-center justify-center px-4 py-2 text-white bg-primary font-semibold border-r border-border/40">{{ $link['label'] }}</span>
                                @else
                                    <a href="{{ $link['url'] }}" class="inline-flex items-center justify-center px-4 py-2 text-text hover:bg-card-hover transition-colors border-r border-border/40 z-10">{{ $link['label'] }}</a>
                                @endif
                            @endif
                        @endforeach
                    </div>

                    @if ($categories->hasMorePages())
                        <a href="{{ $categories->nextPageUrl() }}" class="inline-flex items-center justify-center px-3 py-2 text-primary hover:bg-card-hover transition-colors rounded-r-xl z-10">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span class="inline-flex items-center justify-center px-3 py-2 text-muted bg-surface/50 rounded-r-xl cursor-not-allowed">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </span>
                    @endif
                </nav>
            </div>
        @endif
    </div>

</div>
@endsection
