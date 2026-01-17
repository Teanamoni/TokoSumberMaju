@extends('layouts.admin')

@section('breadcrumbs', 'Pengaturan Profil')

@section('css')
<style>
    /* UI Enhancement */
    .card-settings {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1.5px solid #edf2f7;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #f39c12;
        box-shadow: 0 0 0 4px rgba(243, 156, 18, 0.1);
    }

    .avatar-wrapper {
        position: relative;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .avatar-wrapper:hover {
        transform: scale(1.05);
    }

    .btn-save {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
        color: white;
    }

    label {
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .alert {
        border-radius: 15px;
        border: none;
    }

    .section-title {
        position: relative;
        padding-left: 15px;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 5px;
        bottom: 5px;
        width: 4px;
        background: #f39c12;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa fa-check-circle mr-2 fa-lg"></i>
                <span><strong>Berhasil!</strong> {{ session('success') }}</span>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Notifikasi Error --}}
        @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fa fa-exclamation-triangle mr-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- KARTU 1: FOTO & DATA DIRI --}}
                <div class="col-md-4">
                    <div class="card card-settings mb-4">
                        <div class="card-body text-center p-5">
                            <div class="avatar-wrapper mb-4">
                                {{-- Preview Foto --}}
                                @php
                                    $avatarPath = Auth::user()->avatar ? asset('avatars/'.Auth::user()->avatar) : asset('ElaAdmin/images/admin.jpg');
                                @endphp
                                <img id="avatarPreview" src="{{ $avatarPath }}" 
                                     class="rounded-circle border" 
                                     style="width: 140px; height: 140px; object-fit: cover; border: 5px solid #fff !important; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                                
                                {{-- Ikon Kamera --}}
                                <label for="avatarUpload" class="position-absolute shadow" 
                                       style="bottom: 5px; right: 5px; background: #f39c12; color: #fff; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 3px solid #fff;">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <input type="file" name="avatar" id="avatarUpload" style="display: none;" accept="image/*">
                            </div>
                            
                            <h4 class="font-weight-bold text-dark mb-1">{{ Auth::user()->name }}</h4>
                            <span class="badge badge-pill badge-light text-muted px-3 py-2">Administrator</span>
                            
                            <div class="mt-4 pt-3 border-top text-left">
                                <small class="text-muted d-block mb-1">Terakhir diperbarui:</small>
                                <small class="font-weight-bold text-dark">{{ Auth::user()->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU 2: FORM EDIT --}}
                <div class="col-md-8">
                    <div class="card card-settings">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <h5 class="font-weight-bold text-dark section-title">Informasi Profil</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold small text-muted text-uppercase">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Masukkan nama lengkap">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold small text-muted text-uppercase">Alamat Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="nama@email.com">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold small text-muted text-uppercase">Nomor WhatsApp</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0" style="border-radius: 10px 0 0 10px;"><i class="fa fa-whatsapp text-success"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="628xxxxxxxxxx" style="border-radius: 0 10px 10px 0;">
                                </div>
                                <small class="text-muted mt-1 d-block italic">* Awali dengan kode negara (62)</small>
                            </div>

                            <div class="mt-5 mb-3">
                                <h5 class="font-weight-bold text-danger section-title">Keamanan Akun</h5>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold small text-muted text-uppercase">Password Saat Ini</label>
                                <input type="password" name="current_password" class="form-control" placeholder="Masukkan password lama untuk verifikasi">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold small text-muted text-uppercase">Password Baru</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="Minimal 8 karakter">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold small text-muted text-uppercase">Konfirmasi Password Baru</label>
                                        <input type="password" name="new_password_confirmation" class="form-control" placeholder="Ulangi password baru">
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-save text-white">
                                    <i class="fa fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview Image Logic (Algoritma tetap sama)
    document.getElementById('avatarUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection