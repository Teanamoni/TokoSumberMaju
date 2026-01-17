@extends('layouts.user')

@section('title', 'Kategori: ' . $group_name)

{{-- 1. KOSONGKAN ISI SECTION HERO --}}
@section('hero')
@endsection

@section('header')
    <style>
        /* --- COPY VARIABLES DARI HOME --- */
        :root {
            --primary-color: #F26522;
            --primary-dark: #d35400;
            --navy-color: #2c3e50;
        }

        /* === HAPUS PAKSA HERO CONTAINER (BOX ABU-ABU) === */
        #hero,
        .hero-container {
            display: none !important;
            height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            visibility: hidden !important;
        }

        /* === PENGGANTI BACKGROUND NAVBAR === */
        /* Karena Hero dihapus, kita butuh kotak biru kecil di atas agar navbar terbaca */
        .navbar-bg-placeholder {
            width: 100%;
            height: 80px;
            /* Tinggi navbar */
            background-color: #2c3e50;
            /* Warna Navy */
            position: relative;
            display: block;
        }

        /* === JARAK KONTEN === */
        .content-spacer {
            padding-top: 50px;
            min-height: 80vh;
        }

        /* === CSS KARTU PRODUK (TETAP) === */
        .product-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: #F26522;
        }

        .product-img-wrapper {
            width: 100%;
            height: 250px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            border-bottom: 1px solid #f9f9f9;
        }

        .product-img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .stock-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 4px 12px;
            border-radius: 5px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
            z-index: 10;
        }

        .bg-ready {
            background: #27ae60;
        }

        .bg-empty {
            background: #e74c3c;
        }

        .card-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .btn-wa {
            background-color: #25d366;
            color: white;
            border-radius: 8px;
            padding: 10px 0;
            font-weight: 700;
            width: 100%;
            display: block;
            text-align: center;
            text-decoration: none;
            transition: 0.2s;
            margin-top: 15px;
        }

        .btn-wa:hover {
            background-color: #1ebc57;
            color: white;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')

    {{-- KOTAK BIRU PENGGANTI (Agar Navbar Putih Kelihatan) --}}
    <div class="navbar-bg-placeholder"></div>

    <div class="container content-spacer pb-5">

        {{-- HEADER: Judul Kategori --}}
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="font-weight-bold text-dark mb-1">{{ $group_name }}</h2>
                <p class="text-muted small m-0">Menampilkan {{ count($products) }} produk dalam kategori ini</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('home') }}#katalog"
                    class="btn btn-light border shadow-sm rounded-pill px-4 font-weight-bold text-secondary">
                    <i class="fa fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        {{-- FORM PENCARIAN --}}
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden" style="border: 1px solid #ddd;">
                        <input type="text" name="search" class="form-control border-0" placeholder="Cari barang atau kategori..." value="{{ request('search') }}" style="padding-left: 20px; height: 50px;" required>
                        <div class="input-group-append">
                            <button class="btn btn-warning text-white px-4" type="submit" style="background: var(--primary-color);">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr class="mb-5">

        {{-- GRID PRODUK --}}
        <div class="row">
            @forelse($products as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            @if ($item->stock > 0)
                                <span class="stock-badge bg-ready">Tersedia</span>
                            @else
                                <span class="stock-badge bg-empty">Belum Tersedia</span>
                            @endif

                            <img src="{{ asset('product_image/' . $item->image) }}" alt="{{ $item->name }}"
                                class="product-img"
                                onerror="this.onerror=null;this.src='https://via.placeholder.com/400x400?text=No+Image';">
                        </div>

                        <div class="card-body">
                                <h5 class="product-title">{{ $item->name }}</h5>
                                <h6 class="text-success font-weight-bold mb-2">
                                    Rp. {{ number_format($item->price ?? 0, 0, ',', '.') }}
                                </h6>
                                {{-- <small class="text-muted d-block mb-2">Kode: {{ $item->code ?? '-' }}</small> --}}
                                <p class="text-muted small mb-0" style="line-height: 1.4;">
                                    {{ \Illuminate\Support\Str::limit($item->description, 50) }}
                                </p>

                            <a href="https://wa.me/{{ $admin->phone ?? '628123456789' }}?text=Halo%20Admin,%20saya%20tertarik%20produk%20{{ $item->name }}%20({{ $item->code }})"
                                target="_blank" class="btn-wa shadow-sm">
                                <i class="fa fa-whatsapp mr-2"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border p-5 shadow-sm rounded">
                        <h4 class="text-muted">Produk Kosong</h4>
                        <a href="{{ route('home') }}" class="btn btn-outline-dark mt-3">Cari Kategori Lain</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
