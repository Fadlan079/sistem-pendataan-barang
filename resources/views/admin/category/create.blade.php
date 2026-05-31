@extends('layouts.dashboard')
@section('title', 'Tambah Kategori')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="flex items-center gap-4">
        <a href="{{ route(auth()->user()->role . '.category.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-border/40 text-muted hover:text-primary hover:bg-surface transition-colors shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-primary">Tambah Kategori</h1>
            <p class="text-xs md:text-sm text-muted mt-0.5">Formulir pendaftaran kelas atau kategori baru.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-border/40 p-6 md:p-8 shadow-sm max-w-3xl">
        <form action="{{ route(auth()->user()->role . '.category.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-text">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Masukkan nama kategori"
                       class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('name') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">
                @error('name') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="description" class="text-sm font-semibold text-text">Deskripsi <span class="text-muted font-normal">(Opsional)</span></label>
                <textarea name="description" id="description" rows="4" placeholder="Tuliskan keterangan untuk kategori ini..."
                          class="w-full px-4 py-3 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text resize-y @error('description') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-border/40">
                <a href="{{ route(auth()->user()->role . '.category.index') }}" class="px-6 py-2.5 text-sm font-semibold text-text bg-surface border border-border/40 hover:bg-card-hover rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary/90 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
