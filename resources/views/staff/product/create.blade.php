@extends('layouts.dashboard')
@section('title', 'Tambah Produk Baru')

@section('content')
<div class="p-6 md:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="flex items-center gap-4">
        <a href="{{ route(auth()->user()->role . '.product.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-surface border border-border/40 text-muted hover:text-primary hover:bg-card-hover transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-primary">Tambah Produk</h1>
            <p class="text-sm text-muted mt-0.5">Lengkapi formulir di bawah ini untuk mendaftarkan produk baru.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-border/40 p-6 md:p-8 shadow-sm">
        <form action="{{ route(auth()->user()->role . '.product.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="code" class="text-sm font-semibold text-text">Kode Produk <span class="text-danger">*</span></label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}" required placeholder="Contoh: PRD-001"
                           class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('code') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">
                    @error('code') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-text">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Masukkan nama produk"
                           class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('name') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">
                    @error('name') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="category_id" class="text-sm font-semibold text-text">Kategori <span class="text-danger">*</span></label>
                    <div class="relative">
                        <select name="category_id" id="category_id" required
                                class="w-full px-4 py-2.5 pr-10 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text appearance-none cursor-pointer @error('category_id') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-muted">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('category_id') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="price" class="text-sm font-semibold text-text">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" required placeholder="0"
                           class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('price') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">
                    @error('price') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="stock" class="text-sm font-semibold text-text">Stok Awal <span class="text-danger">*</span></label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0" required
                           class="w-full px-4 py-2.5 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text @error('stock') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">
                    @error('stock') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="description" class="text-sm font-semibold text-text">Deskripsi Produk <span class="text-muted font-normal">(Opsional)</span></label>
                <textarea name="description" id="description" rows="4" placeholder="Tuliskan detail spesifikasi atau keterangan produk..."
                          class="w-full px-4 py-3 rounded-xl border border-border/60 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm bg-bg text-text resize-y @error('description') border-danger/50 focus:ring-danger/20 focus:border-danger @enderror">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-danger font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-border/40">
                <a href="{{ route(auth()->user()->role . '.product.index') }}" class="px-6 py-2.5 text-sm font-semibold text-text bg-surface border border-border/40 hover:bg-card-hover rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary/90 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
