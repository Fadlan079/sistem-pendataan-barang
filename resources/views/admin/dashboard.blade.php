@extends('layouts.dashboard')
@section('title', 'Panel Utama - Administrator')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="p-4 md:p-6 lg:p-8 space-y-6 min-h-screen font-sans text-text">

    <div class="bg-primary relative overflow-hidden rounded-2xl shadow-sm text-white p-6 md:p-8 flex flex-col justify-center min-h-[140px]">
        <div class="relative z-10 w-full md:w-2/3">
            <span class="inline-block px-3 py-1 bg-white/20 rounded-md text-[10px] font-bold tracking-wider uppercase mb-3 backdrop-blur-sm">Status Operasional Aktif</span>
            <h2 class="text-lg md:text-xl font-bold mb-2">Pusat Kendali Administrator</h2>
            <p class="text-sm text-white/80 leading-relaxed">Seluruh data metrik, inventaris produk, dan kontrol kredensial pengguna berada di bawah pengawasan otorisasi Anda.</p>
        </div>
        <div class="absolute -right-10 -top-10 opacity-10 pointer-events-none">
            <i class="fa-solid fa-chart-pie text-[250px]"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-info/10 text-info flex items-center justify-center shrink-0">
                <i class="fa-solid fa-box text-xl"></i>
            </div>
            <div>
                <div class="text-xs font-bold tracking-wider text-muted uppercase">Total Produk</div>
                <div class="text-2xl font-extrabold text-text mt-1">{{ number_format($metrics['product_count']) }}</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-warning/10 text-warning flex items-center justify-center shrink-0">
                <i class="fa-solid fa-tags text-xl"></i>
            </div>
            <div>
                <div class="text-xs font-bold tracking-wider text-muted uppercase">Total Kategori</div>
                <div class="text-2xl font-extrabold text-text mt-1">{{ number_format($metrics['category_count']) }}</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
            <div>
                <div class="text-xs font-bold tracking-wider text-muted uppercase">Otorisasi Pengguna</div>
                <div class="text-2xl font-extrabold text-text mt-1">{{ number_format($metrics['user_count']) }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm">
            <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4">Metrik Pertumbuhan Pengguna</h3>
            <div class="relative h-72 w-full">
                <canvas id="userTrendChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-border/40 p-6 shadow-sm">
            <h3 class="text-sm font-bold tracking-wider text-muted uppercase mb-4">Distribusi Produk per Kategori</h3>
            <div class="relative h-72 w-full flex justify-center">
                <canvas id="categoryDistributionChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { font: { family: "'Inter', sans-serif", size: 12 } } }
        }
    };

    const userChartData = {!! json_encode($adminChart) !!};
    const catChartData = {!! json_encode($categoryChart) !!};

    new Chart(document.getElementById('userTrendChart'), {
        type: 'bar',
        data: {
            labels: userChartData.labels,
            datasets: [{
                label: 'Akun Baru',
                data: userChartData.data,
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderRadius: 4,
            }]
        },
        options: {
            ...commonOptions,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    new Chart(document.getElementById('categoryDistributionChart'), {
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
            ...commonOptions,
            cutout: '65%'
        }
    });
});
</script>
@endsection
