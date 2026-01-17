@extends('layouts.admin')

@section('title', 'Profil Toko')

@section('breadcrumbs', 'Profil Toko')

@section('second-breadcrumb')
    <li class="breadcrumb-item active">Detail Profil</li>
@endsection

@section('css')
<style>
    /* Container Utama */
    .profile-container {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        border: 1px solid #edf2f7;
    }

    /* Bagian Banner & Foto Profil */
    .profile-hero {
        position: relative;
        height: 250px;
    }
    .hero-bg {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .logo-wrapper {
        position: absolute;
        bottom: -50px;
        left: 40px;
        width: 130px;
        height: 130px;
        border-radius: 20px;
        border: 5px solid #fff;
        background: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .logo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Content Area */
    .profile-body {
        padding: 70px 40px 40px 40px;
    }

    /* Header & Action */
    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
    }

    /* Segmentasi Informasi */
    .info-segment {
        margin-bottom: 35px;
    }
    .segment-title {
        font-size: 0.85rem;
        font-weight: 800;
        color: #4e73df;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    .segment-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e3e6f0;
        margin-left: 15px;
    }
    .segment-title i {
        margin-right: 10px;
    }

    /* Grid Detail */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }
    .detail-item {
        background: #f8fafc;
        padding: 15px 20px;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
    }
    .detail-label {
        font-size: 0.75rem;
        color: #94a3b8;
        margin-bottom: 5px;
        font-weight: 600;
    }
    .detail-value {
        color: #1e293b;
        font-weight: 700;
        line-height: 1.5;
    }

    /* Deskripsi Area */
    .description-box {
        color: #475569;
        line-height: 1.8;
        font-size: 1rem;
        background: #fff;
    }

    .footer-quote {
        margin-top: 40px;
        padding: 20px;
        border-radius: 12px;
        background: #f1f5f9;
        border-left: 4px solid #cbd5e1;
        font-style: italic;
        color: #64748b;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    @if (count($abouts) > 0)
    <div class="profile-container mb-5">
        
        {{-- BAGIAN VISUAL (BANNER & LOGO) --}}
        <div class="profile-hero">
            <img src="{{ asset('about_image/' . ($abouts[0]->hero_bg ?? 'default.jpg')) }}" class="hero-bg" alt="Banner">
            <div class="logo-wrapper">
                <img src="{{ asset('about_image/' . $abouts[0]->image) }}" class="logo-img" alt="Logo">
            </div>
        </div>

        <div class="profile-body">
            {{-- HEADER NAMA & TOMBOL --}}
            <div class="header-flex">
                <div>
                    <h2 class="font-weight-bold text-dark mb-1">Profil Bisnis</h2>
                    <p class="text-muted"><i class="fa fa-check-circle text-primary"></i> Terverifikasi sebagai profil publik</p>
                </div>
                <a href="{{ route('abouts.edit', [$abouts[0]->id]) }}" class="btn btn-warning px-4 py-2 shadow-sm font-weight-bold" style="border-radius: 10px;">
                    <i class="fa fa-pencil mr-2"></i> Perbarui Profil
                </a>
            </div>

            {{-- SEGMEN 1: DESKRIPSI --}}
            <div class="info-segment">
                <div class="segment-title">
                    <i class="fa fa-info-circle"></i> Tentang Toko
                </div>
                <div class="description-box px-2">
                    {!! $abouts[0]->caption !!}
                </div>
            </div>

            {{-- SEGMEN 2: DETAIL KONTAK & OPERASIONAL --}}
            <div class="info-segment">
                <div class="segment-title">
                    <i class="fa fa-address-card"></i> Informasi Kontak & Operasional
                </div>
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">WhatsApp</div>
                        <div class="detail-value text-success">
                            <i class="fa fa-whatsapp mr-1"></i> +{{ $abouts[0]->whatsapp ?? '-' }}
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jam Operasional</div>
                        <div class="detail-value" style="white-space: pre-line;">
                            {!! nl2br(e($abouts[0]->jam_operasional ?? '-')) !!}
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Alamat Lengkap</div>
                        <div class="detail-value small">
                            {{ $abouts[0]->alamat ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEGMEN 3: FOOTER BRANDING --}}
            <div class="footer-quote">
                <div class="detail-label">Slogan / Footer Text</div>
                "{{ $abouts[0]->footer_text ?? '-' }}"
            </div>
        </div>
    </div>
    @else
    {{-- Tampilan jika data kosong --}}
    <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 20px;">
        <div class="card-body">
            <i class="fa fa-store fa-4x text-light mb-4"></i>
            <h4 class="font-weight-bold">Profil Belum Tersedia</h4>
            <p class="text-muted">Silakan buat profil toko Anda untuk pertama kali.</p>
            <a href="{{ route('abouts.create') }}" class="btn btn-primary px-5 py-2 mt-3 shadow-sm" style="border-radius: 10px;">
                <i class="fa fa-plus mr-2"></i> Buat Profil
            </a>
        </div>
    </div>
    @endif
</div>
@endsection