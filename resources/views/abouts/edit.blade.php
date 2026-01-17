@extends('layouts.admin')

@section('title', 'Edit Profil Toko')

@section('breadcrumbs', '')

@section('second-breadcrumb')
    <li class="breadcrumb-item active">Edit Profil Toko</li>
@endsection

@section('css')
<style>
    /* Custom Styling untuk Tampilan yang Lebih Mewah */
    .form-section {
        background: #ffffff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.02);
    }
    
    .input-custom {
        border-radius: 10px !important;
        border: 1.5px solid #f1f3f5 !important;
        padding: 12px 15px !important;
        background-color: #ffffff !important;
        transition: all 0.3s ease;
    }

    .input-custom:focus {
        border-color: #4e73df !important;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1) !important;
        background-color: #fff !important;
    }

    .preview-card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
        border: 1px solid #edf2f7;
    }

    .preview-card:hover {
        transform: translateY(-5px);
    }

    .label-custom {
        font-weight: 700;
        color: #4a5568;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }

    .btn-save-custom {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        border-radius: 12px;
        padding: 14px 40px;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
        transition: all 0.3s ease;
    }

    .btn-save-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(78, 115, 223, 0.4);
        color: white;
    }

    .icon-box {
        width: 45px;
        height: 45px;
        background: rgba(78, 115, 223, 0.1);
        color: #4e73df;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sticky-preview {
        position: sticky;
        top: 25px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body p-4 p-lg-5">

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px; background: #d1e7dd; color: #0f5132;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle mr-3 fa-lg"></i>
                            <span><strong>Berhasil!</strong> {{ session('success') }}</span>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Header --}}
                <div class="d-flex align-items-center mb-5">
                    <div class="icon-box mr-3">
                        <i class="fas fa-store fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="mb-0 font-weight-bold text-dark">Konfigurasi Profil Toko</h3>
                        <p class="text-muted mb-0">Sesuaikan tampilan dan informasi publik bisnis Anda.</p>
                    </div>
                </div>

                <form action="{{ route('abouts.update', [$about->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Kolom Kiri: Preview Visual --}}
                        <div class="col-lg-4 mb-4">
                            <div class="sticky-preview">
                                <h6 class="label-custom mb-3"><i class="fas fa-eye mr-2"></i>Live Preview</h6>
                                
                                <div class="card preview-card shadow-sm mb-4">
                                    <div class="bg-light py-2 px-3 border-bottom d-flex justify-content-between align-items-center">
                                        <small class="font-weight-bold text-muted">LOGO TOKO</small>
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                    <img src="{{ asset('about_image/' . $about->image) }}" class="img-fluid" style="height: 200px; object-fit: cover;">
                                </div>

                                <div class="card preview-card shadow-sm">
                                    <div class="bg-light py-2 px-3 border-bottom d-flex justify-content-between align-items-center">
                                        <small class="font-weight-bold text-muted">BANNER HERO</small>
                                        <i class="fas fa-desktop text-muted"></i>
                                    </div>
                                    <img src="{{ asset('about_image/' . ($about->hero_bg ?? 'default.jpg')) }}" class="img-fluid" style="height: 140px; object-fit: cover;">
                                </div>
                                
                                <div class="mt-4 p-3 bg-light rounded" style="border-radius: 12px; border: 1px dashed #cbd5e0;">
                                    <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Gunakan gambar berkualitas tinggi (min. 1200px untuk Banner) untuk hasil maksimal.</small>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Form Fields --}}
                        <div class="col-lg-8">
                            <div class="form-section shadow-sm border">
                                
                                {{-- Deskripsi --}}
                                <div class="form-group mb-4">
                                    <label for="content" class="label-custom"><i class="fas fa-file-alt mr-2"></i>Tentang Toko</label>
                                    <div class="shadow-sm rounded overflow-hidden">
                                        <textarea name="caption" id="content" rows="6" class="form-control ckeditor border-0">{{ $about->caption }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- WhatsApp --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="label-custom"><i class="fab fa-whatsapp mr-2"></i>WhatsApp Business</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white border-right-0 input-custom" style="border-radius: 10px 0 0 10px;"><i class="text-success fas fa-phone-alt"></i></span>
                                                </div>
                                                <input type="text" name="whatsapp" value="{{ $about->whatsapp }}" class="form-control input-custom border-left-0" placeholder="628xxxxxxxxxx">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Jam Operasional --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="label-custom"><i class="fas fa-clock mr-2"></i>Jam Operasional</label>
                                            <textarea name="jam_operasional" rows="1" class="form-control input-custom" placeholder="Senin-Jumat: 08:00 - 20:00">{{ $about->jam_operasional }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- Alamat --}}
                                <div class="form-group mb-4">
                                    <label class="label-custom"><i class="fas fa-map-marked-alt mr-2"></i>Alamat Fisik</label>
                                    <textarea name="alamat" rows="2" class="form-control input-custom">{{ $about->alamat }}</textarea>
                                </div>

                                {{-- Footer --}}
                                <div class="form-group mb-4">
                                    <label class="label-custom"><i class="fas fa-signature mr-2"></i>Branding Footer</label>
                                    <input type="text" name="footer_text" value="{{ $about->footer_text }}" class="form-control input-custom">
                                </div>

                                {{-- File Uploads --}}
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-custom">Unggah Logo Baru</label>
                                            <input type="file" name="image" class="form-control-file p-2 w-100 bg-white border rounded" style="border-radius: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-custom">Unggah Banner Baru</label>
                                            <input type="file" name="hero_bg" class="form-control-file p-2 w-100 bg-white border rounded" style="border-radius: 10px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mt-5 pt-3 border-top">
                                    <button type="submit" class="btn btn-save-custom btn-lg text-white">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i> Update Profil Toko
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="/templateEditor/ckeditor/ckeditor.js"></script>
    <script src="/templateEditor/ckeditor/config.js"></script>
    <script>
        CKEDITOR.replace('content', {
            height: 300,
            skin: 'moono-lisa',
            toolbarGroups: [
                {"name": "basicstyles", "groups": ["basicstyles"]},
                {"name": "links", "groups": ["links"]},
                {"name": "paragraph", "groups": ["list", "blocks"]},
                {"name": "styles", "groups": ["styles"]}
            ],
            removeButtons: 'Strike,Subscript,Superscript,Anchor,Specialchar,Image,Print,Save,NewPage,Source,Table,Iframe,PageBreak,CreateDiv,Flash,Smiley'
        });
    </script>
@endsection