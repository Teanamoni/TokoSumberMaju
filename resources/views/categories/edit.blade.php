@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('breadcrumbs', 'Kategori')
@section('second-breadcrumb')
    <li>Edit Kategori</li>
@endsection

@section('css')
    <style>
        .card-edit {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            background: #ffffff;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .preview-container {
            width: 100%;
            height: 250px;
            border-radius: 16px;
            border: 2px dashed #cbd5e1;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            transition: 0.3s;
        }
        #image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .btn-update {
            background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            color: white !important;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(15, 23, 42, 0.2);
        }
        .custom-file-label {
            border-radius: 12px;
            padding: 12px;
            height: auto;
        }
        .custom-file-label::after {
            height: auto;
            padding: 12px;
            border-radius: 0 12px 12px 0;
            content: "Pilih";
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <form action="{{ route('categories.update', [$category->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-edit">
                    <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #f1f5f9;">
                        <div>
                            <h5 class="m-0 font-weight-bold text-dark">
                                <i class="fa fa-pencil-alt mr-2 text-primary"></i> Edit Kategori
                            </h5>
                            <small class="text-muted">ID Kategori: #{{ $category->id }}</small>
                        </div>
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light border px-3" style="border-radius: 10px;">
                            <i class="fa fa-arrow-left mr-1"></i> Batal
                        </a>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 12px;">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            {{-- Sisi Kiri: Form Input --}}
                            <div class="col-md-7">
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark mb-2">Nama Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                           value="{{ old('name', $category->name) }}" placeholder="Contoh: Elektronik, Pakaian, dll" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    <small class="text-muted mt-2 d-block">Nama kategori akan muncul di halaman utama website.</small>
                                </div>
                                
                                <div class="alert alert-info border-0" style="border-radius: 12px; background: #eff6ff; color: #1e40af;">
                                    <small><i class="fa fa-info-circle mr-1"></i> Tip: Gunakan nama yang singkat dan jelas agar mudah ditemukan pembeli.</small>
                                </div>
                            </div>

                            {{-- Sisi Kanan: Upload & Preview --}}
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark mb-2">Visual Kategori</label>
                                    
                                    {{-- Live Preview Container --}}
                                    <div class="preview-container mb-3 shadow-sm">
                                        @if ($category->image)
                                            <img id="image-preview" src="{{ asset('category_image/' . $category->image) }}" alt="Preview">
                                        @else
                                            <div id="placeholder-preview" class="text-center text-muted">
                                                <i class="fa fa-cloud-upload-alt fa-3x mb-2" style="opacity: 0.3;"></i>
                                                <p class="small m-0">Pratinjau Gambar</p>
                                            </div>
                                            <img id="image-preview" src="" style="display: none;">
                                        @endif
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="imageInput" accept="image/*">
                                        <label class="custom-file-label text-truncate" for="imageInput">Pilih foto baru...</label>
                                    </div>
                                    <small class="text-muted d-block mt-2 font-italic" style="font-size: 11px;">
                                        *Format: JPG, PNG, JPEG. Max: 2MB.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white py-4 d-flex justify-content-end" style="border-top: 1px solid #f1f5f9;">
                        <button type="submit" class="btn btn-update px-5">
                            <i class="fa fa-save mr-2"></i> Perbarui Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Fitur Live Preview Gambar
        document.getElementById('imageInput').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                // Tampilkan gambar preview
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('placeholder-preview');
                
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                if(placeholder) placeholder.style.display = 'none';

                // Update label nama file
                const fileName = file.name;
                const label = this.nextElementSibling;
                label.innerHTML = fileName;
            }
        };
    </script>
@endsection