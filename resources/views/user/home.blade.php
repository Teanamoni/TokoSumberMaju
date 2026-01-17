@extends('layouts.user')

@section('header')
    <style>
        /* --- IMPORT PREMIUM FONTS --- */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #F26522;
            --primary-dark: #d35400;
            --navy: #0f172a;
            --slate: #475569;
            --light-bg: #f8fafc;
            --white: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--white);
            color: var(--navy);
            scroll-behavior: smooth;
        }

        /* --- NAVBAR REFINEMENT --- */
        .navbar {
            transition: all 0.4s ease-in-out;
            padding: 20px 0;
            background: transparent !important;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            padding: 12px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        /* --- HERO SECTION (DYNAMIC BACKGROUND) --- */
        #hero {
            width: 100%;
            height: 100vh;
            /* Background mengambil dari database, jika kosong pakai gambar default */
            background: url('{{ asset('about_image/' . ($about->hero_bg ?? 'hero2-bg.png')) }}') center center no-repeat;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        #hero::before {
            content: "";
            background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.5) 100%);
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .hero-container {
            position: relative;
            z-index: 2;
        }

        #hero h1 {
            color: var(--white);
            font-size: clamp(42px, 6vw, 75px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
            text-align: left;
        }

        .hero-btns {
            display: flex;
            gap: 15px;
            justify-content: flex-start;
        }

        /* --- BUTTONS --- */
        .btn-custom {
            padding: 16px 36px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none !important;
        }

        .btn-orange {
            background: var(--primary);
            color: var(--white) !important;
            border: none;
            box-shadow: 0 10px 20px rgba(242, 101, 34, 0.25);
        }

        .btn-orange:hover {
            background: var(--primary-dark);
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(242, 101, 34, 0.35);
        }

        .btn-outline-white {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: var(--white) !important;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
        }

        .btn-outline-white:hover {
            background: var(--white);
            color: var(--navy) !important;
            border-color: var(--white);
            transform: translateY(-4px);
        }

        /* --- SECTION STYLING --- */
        .section-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 12px;
        }

        .title-accent {
            width: 60px;
            height: 5px;
            background: var(--primary);
            margin: 0 auto 35px;
            border-radius: 10px;
        }

        /* --- PRODUCT CARD --- */
        .product-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid #f1f5f9;
            transition: all 0.4s ease;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }

        .product-img-wrapper {
            height: 250px;
            overflow: hidden;
        }

        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-details {
            padding: 30px;
            text-align: center;
            flex-grow: 1;
        }

        .product-title {
            font-weight: 700;
            font-size: 20px;
            color: var(--navy);
            margin-bottom: 12px;
        }

        .price-badge {
            background: #f0fdf4;
            color: #16a34a;
            padding: 6px 16px;
            border-radius: 10px;
            font-weight: 800;
            display: inline-block;
            margin-bottom: 20px;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            #hero { text-align: center; }
            #hero h1 { text-align: center; margin-left: auto; margin-right: auto; }
            .hero-btns { justify-content: center; flex-direction: column; }
        }
    </style>
@endsection

@section('hero')
    <div class="container hero-container">
        <div class="row">
            <div class="col-lg-9 col-xl-8">
                 <br>
                <div class="hero-btns wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 500px;">
                    {{-- Menggunakan nomor WA dari database --}}
                    <a href="https://wa.me/{{ $about->whatsapp ?? '628123456789' }}" target="_blank" class="btn-custom btn-orange">
                        <i class="fa fa-whatsapp"></i> Hubungi Kami
                    </a>
                    <a href="#katalog" class="btn-custom btn-outline-white scrollto">
                        Lihat Katalog <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- === SECTION KATALOG === --}}
    <section id="katalog" class="py-5" style="background: var(--light-bg);">
        <div class="container py-5">
            <div class="text-center mb-5 wow fadeInUp">
                <h3 class="section-title">Kategori Produk</h3>
                <div class="title-accent"></div>
                
                <div class="row justify-content-center mt-5">
                    <div class="col-md-7">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="input-group p-2 bg-white shadow-sm rounded-pill border">
                                <input type="text" name="search" class="form-control border-0 px-4" placeholder="Cari barang atau kategori..." value="{{ request('search') }}" required>
                                <button class="btn btn-orange rounded-pill px-4" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $groupName => $items)
                    @php
                        $firstItem = $items->first();
                        $productList = $items->pluck('name')->join(', ');
                    @endphp
                    <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                        <a href="{{ url('product/' . $firstItem->id) }}" class="text-decoration-none">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <img src="{{ asset('product_image/' . $firstItem->image) }}" alt="{{ $groupName }}"
                                         onerror="this.onerror=null;this.src='https://via.placeholder.com/400x300?text=No+Image';">
                                </div>
                                <div class="product-details">
                                    <h4 class="product-title">{{ $groupName }}</h4>
                                    <p class="text-muted small mb-4" style="min-height: 45px;">
                                        {{ Str::limit($productList, 80) }}
                                    </p>
                                    <div class="price-badge">
                                        <span class="small font-weight-normal text-muted">Mulai </span>
                                        Rp {{ number_format($firstItem->price ?? 0, 0, ',', '.') }}
                                    </div>
                                    <div class="btn btn-outline-dark btn-sm w-100 rounded-pill font-weight-bold">
                                        Lihat {{ count($items) }} Produk
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- === SECTION TENTANG KAMI === --}}
    <section id="tentang" class="py-5" style="background: #fffcf9; position: relative; overflow: hidden;">
        <div class="container py-5 position-relative" style="z-index: 2;">
            @if ($about)
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0 wow fadeInLeft">
                        <div class="position-relative">
                            <div style="position: absolute; top: 20px; left: 20px; right: -20px; bottom: -20px; background: #feede5; border-radius: 30px; z-index: 0;"></div>
                            <div class="image-wrapper" style="position: relative; z-index: 1;">
                                <img src="{{ asset('about_image/' . $about->image) }}" alt="Tentang Kami"
                                     class="img-fluid shadow-lg" 
                                     style="border-radius: 30px; border: 10px solid #ffffff; object-fit: cover; width: 100%; height: 400px;"
                                     onerror="this.src='https://via.placeholder.com/600x400?text=Tentang+Toko'">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 pl-lg-5 wow fadeInRight">
                        <div class="p-lg-3">
                            <span style="display: inline-block; background: rgba(242, 101, 34, 0.1); color: #F26522; padding: 8px 20px; border-radius: 50px; font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px;">
                                Profil Toko Bangunan
                            </span>
                            <h2 class="mb-4" style="font-weight: 800; color: #0f172a; font-size: clamp(30px, 4vw, 40px);">
                                Tentang Kami
                            </h2>
                            <div class="about-content" style="color: #475569; line-height: 1.9; font-size: 16px;">
                                {!! $about->caption !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- === SECTION KONTAK & LOKASI === --}}
    <section id="kontak" class="py-5" style="background: #ffffff; position: relative;">
        <div class="container py-5">
            <div class="text-center mb-5 wow fadeInUp">
                <h3 style="font-weight: 800; font-size: 32px; color: #0f172a; margin-bottom: 10px;">Hubungi & Kunjungi Kami</h3>
                <div style="width: 50px; height: 6px; background: #F26522; margin: 0 auto; border-radius: 10px; opacity: 0.8;"></div>
            </div>

            <div class="row">
                {{-- Alamat DARI DATABASE --}}
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="contact-card" style="background: #fff5f0; border: 2px solid #fff; border-radius: 30px; padding: 40px 30px; text-align: center; height: 100%;">
                        <i class="fa fa-map-marker" style="font-size: 30px; color: #F26522; margin-bottom: 20px;"></i>
                        <h5 style="font-weight: 700; color: #0f172a;">Alamat Toko</h5>
                        <p style="color: #64748b; font-size: 14px;">{{ $about->alamat ?? 'Alamat belum diatur' }}</p>
                    </div>
                </div>

                {{-- WhatsApp DARI DATABASE --}}
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="contact-card" style="background: #f0fdf4; border: 2px solid #fff; border-radius: 30px; padding: 40px 30px; text-align: center; height: 100%;">
                        <i class="fa fa-whatsapp" style="font-size: 32px; color: #22c55e; margin-bottom: 20px;"></i>
                        <h5 style="font-weight: 700; color: #0f172a;">WhatsApp</h5>
                        <p style="color: #64748b; font-size: 15px;">+{{ $about->whatsapp ?? '628123456789' }}</p>
                        <a href="https://wa.me/{{ $about->whatsapp ?? '628123456789' }}" target="_blank" class="text-success font-weight-bold">Chat Sekarang</a>
                    </div>
                </div>

                {{-- Jam Operasional DARI DATABASE --}}
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="contact-card" style="background: #fdfaf0; border: 2px solid #fff; border-radius: 30px; padding: 40px 30px; text-align: center; height: 100%;">
                        <i class="fa fa-clock-o" style="font-size: 30px; color: #eab308; margin-bottom: 20px;"></i>
                        <h5 style="font-weight: 700; color: #0f172a;">Jam Operasional</h5>
                        <p style="color: #64748b; font-size: 14px; white-space: pre-line;">{!! nl2br(e($about->jam_operasional ?? 'Jam belum diatur')) !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 wow fadeInUp" data-wow-delay="0.8s">
                <div class="col-12">
                    <div style="border-radius: 30px; overflow: hidden; border: 10px solid #ffffff; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.3597583416786!2d110.4027572743096!3d-6.966817268213106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f5003bd1fb73%3A0x891d13efbfbfc30b!2sToko%20besi%20dan%20bahan%20bangunan%20Sumber%20Maju!5e0!3m2!1sid!2sid!4v1768380691599!5m2!1sid!2sid" 
                            width="100%" 
                            height="450" 
                            style="border:0; display: block;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
    </section>

    <style>
        .contact-card { transition: 0.3s; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .contact-card:hover { transform: translateY(-10px); border-color: #F26522 !important; }
    </style>
@endsection