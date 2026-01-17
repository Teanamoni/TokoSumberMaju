@extends('layouts.admin')

@section('breadcrumbs', 'Dashboard Overview')

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .content-wrapper {
            background-color: #f4f7fe;
            padding: 25px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- STAT CARDS GRID --- */
        .stat-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            height: 110px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 18px;
            flex-shrink: 0;
        }

        .icon-web { background: #f4f7fe; color: #4318ff; }
        .icon-total { background: #e0e8ff; color: #3b82f6; }
        .icon-habis { background: #ffeded; color: #ee5d50; }
        .icon-ready { background: #e6faf5; color: #05cd99; }

        .stat-info span {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #a3aed0;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .stat-info h2 {
            font-size: 22px;
            font-weight: 800;
            color: #1b2559;
            margin: 0;
        }

        /* --- CHART CARD --- */
        .chart-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 30px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.02);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .badge-live {
            background: #e6faf5;
            color: #05cd99;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .dot-live {
            width: 8px;
            height: 8px;
            background: #05cd99;
            border-radius: 50%;
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(5, 205, 153, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(5, 205, 153, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(5, 205, 153, 0); }
        }

        .btn-visit {
            background: #1b2559;
            color: white;
            border-radius: 12px;
            padding: 8px 18px;
            font-weight: 700;
            font-size: 12px;
            transition: 0.3s;
            text-decoration: none !important;
        }

        .btn-visit:hover {
            background: #4318ff;
            color: white;
            transform: translateY(-2px);
        }
    </style>
@endsection

@section('content')
<div class="content-wrapper">
    
    {{-- BARIS 1 (Sesuai Sketsa: Web Stat & Total Produk) --}}
    <div class="row">
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon icon-web">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="stat-info d-flex justify-content-between align-items-center w-100">
                    <div>
                        <span>Web Stat</span>
                        <h2 style="color: #05cd99;">Online</h2>
                    </div>
                    <a href="{{ url('/') }}" target="_blank" class="btn-visit">Visit Web</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon icon-total">
                    <i class="fa fa-box-open"></i>
                </div>
                <div class="stat-info">
                    <span>Total Produk</span>
                    <h2>{{ number_format($total_katalog ?? 0) }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 2 (Sesuai Sketsa: Stok Habis & Stok Tersedia) --}}
    <div class="row">
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon icon-habis">
                    <i class="fa fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <span>Produk Stok Habis</span>
                    <h2>{{ number_format($produk_tidak_tersedia ?? 0) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon icon-ready">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <span>Produk Stok Tersedia</span>
                    <h2>{{ number_format($produk_tersedia ?? 0) }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS GRAFIK (Sesuai Sketsa: Grafik Pengunjung) --}}
    <div class="row">
        <div class="col-12">
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h4 class="font-weight-bold mb-2" style="color: #1b2559;">Grafik Pengunjung</h4>
                        <div class="badge-live">
                            <div class="dot-live"></div> Monthly Analysis
                        </div>
                    </div>
                    <div class="text-right">
                        <span style="font-size: 11px; font-weight: 700; color: #a3aed0;">TOTAL VISITS</span>
                        <h3 class="font-weight-bold m-0" style="color: #1b2559;">{{ number_format($total_pengunjung ?? 0) }}</h3>
                    </div>
                </div>
                <div style="height: 350px;">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('trafficChart').getContext('2d');
        
        var gradient = ctx.createLinearGradient(0, 0, 0, 350);
        gradient.addColorStop(0, 'rgba(67, 24, 255, 0.15)');
        gradient.addColorStop(1, 'rgba(67, 24, 255, 0)');

        // Label Januari sampai Desember
        const labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const dataValues = {!! json_encode($chartValues) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengunjung',
                    data: dataValues,
                    backgroundColor: gradient,
                    borderColor: '#4318ff',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4318ff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                        ticks: { color: '#a3aed0', font: { size: 12, weight: '600' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#a3aed0', font: { size: 12, weight: '600' } }
                    }
                }
            }
        });
    });
</script>
@endsection