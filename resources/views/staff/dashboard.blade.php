@extends('layouts.dashboard')
@section('title', 'Panel Utama - Staff Operasional')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="p-4 md:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="bg-info relative overflow-hidden rounded-2xl shadow-sm text-white p-6 md:p-8 flex flex-col justify-center min-h-[140px]">
        <div class="relative z-10 w-full md:w-2/3">
            <span class="inline-block px-3 py-1 bg-white/20 rounded-md text-[10px] font-bold tracking-wider uppercase mb-3 backdrop-blur-sm">Sesi Aktif</span>
            <h2 class="text-lg md:text-xl font-bold mb-2">Panel Operasional Harian</h2>
            <p class="text-sm text-white/80 leading-relaxed">Fokus otorisasi Anda dibatasi pada pemantauan dan pengelolaan data inventaris produk serta kategorisasi.</p>
        </div>
        <div class="absolute -right-10 -top-10 opacity-10 pointer-events-none">
            <i class="fa-solid fa-clipboard-list text-[250px]"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-info/10 text-info flex items-center justify-center shrink-0">
                <i class="fa-solid fa-box text-xl"></i>
            </div>
            <div>
                <div class="text-xs font-bold tracking-wider text-muted uppercase">Inventaris Produk</div>
                <div class="text-2xl font-extrabold text-text mt-1">{{ number_format($metrics['product_count']) }}</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-warning/10 text-warning flex items-center justify-center shrink-0">
                <i class="fa-solid fa-tags text-xl"></i>
            </div>
            <div>
                <div class="text-xs font-bold tracking-wider text-muted uppercase">Klasifikasi Kategori</div>
                <div class="text-2xl font-extrabold text-text mt-1">{{ number_format($metrics['category_count']) }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-2xl border border-border/40 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-border/40">
                <h3 class="text-sm font-bold tracking-wider text-muted uppercase">Log Penambahan Produk Terkini</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface/50 border-b border-border/40 text-xs uppercase text-muted">
                        <tr>
                            <th class="px-6 py-3 font-bold">Nama Produk</th>
                            <th class="px-6 py-3 font-bold">Kategori</th>
                            <th class="px-6 py-3 font-bold">Waktu Entri</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border/20 text-sm">
                        @forelse($recentProducts as $product)
                        <tr class="hover:bg-surface/30">
                            <td class="px-6 py-3 font-medium text-text">{{ $product->name }}</td>
                            <td class="px-6 py-3 text-muted">{{ $product->category->name ?? 'Tanpa Kategori' }}</td>
                            <td class="px-6 py-3 text-muted text-xs">{{ $product->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-6 text-center text-muted">Tidak ada data operasional.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm">
            <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4">Rasio Inventaris</h3>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="categoryDistributionChartStaff"></canvas>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const catChartData = {!! json_encode($categoryChart) !!};

    new Chart(document.getElementById('categoryDistributionChartStaff'), {
        type: 'doughnut',
        data: {
            labels: catChartData.labels,
            datasets: [{
                data: catChartData.data,
                backgroundColor: [
                    '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4'
                ],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { font: { family: "'Inter', sans-serif", size: 11 } } }
            }
        }
    });
});
</script>
@endsection
