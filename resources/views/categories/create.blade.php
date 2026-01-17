@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')
@section('breadcrumbs', 'Kategori')
@section('second-breadcrumb')
    <li>Tambah Baru</li>
@endsection

@section('css')
    <style>
        .card-create {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.03);
            background: #ffffff;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #10b981; /* Warna hijau emerald untuk mode "Tambah" */
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
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
            display: none; /* Sembunyi dulu sebelum ada file */
        }
        .btn-save {
            background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            color: white !important;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-save:hover {
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
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-create">
                    <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #f1f5f9;">
                        <div>
                            <h5 class="m-0 font-weight-bold text-dark">
                                <i class="fa fa-plus-circle mr-2 text-success"></i> Buat Kategori Baru
                            </h5>
                            <small class="text-muted">Lengkapi data di bawah untuk menambah kategori produk.</small>
                        </div>
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light border px-3" style="border-radius: 10px;">
                            <i class="fa fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            {{-- Input Data --}}
                            <div class="col-md-7">
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark mb-2 small text-uppercase" style="letter-spacing: 1px;">Nama Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                           value="{{ old('name') }}" placeholder="Misal: Perabotan Rumah" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    <small class="text-muted mt-2 d-block small">Nama unik kategori yang akan tampil di katalog.</small>
                                </div>
                                
                                <div class="alert border-0 p-3" style="border-radius: 15px; background: #f0fdf4; color: #166534;">
                                    <div class="d-flex">
                                        <i class="fa fa-lightbulb mr-2 mt-1"></i>
                                        <small>Gunakan nama kategori yang umum agar pelanggan lebih mudah memfilter produk Anda.</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Visual/Image --}}
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark mb-2 small text-uppercase" style="letter-spacing: 1px;">Visual Kategori</label>
                                    
                                    {{-- Live Preview --}}
                                    <div class="preview-container mb-3 shadow-sm border">
                                        <div id="placeholder-preview" class="text-center text-muted p-3">
                                            <i class="fa fa-image fa-3x mb-2" style="opacity: 0.2;"></i>
                                            <p class="small m-0">Belum Ada Gambar<br><span class="text-xs">(Pilih file untuk melihat pratinjau)</span></p>
                                        </div>
                                        <img id="image-preview" src="" alt="Preview">
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="imageUpload" accept="image/*">
                                        <label class="custom-file-label text-truncate shadow-sm" for="imageUpload">Pilih File...</label>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="text-muted font-italic" style="font-size: 11px;">Max size: 2MB</small>
                                        <small class="text-muted font-italic" style="font-size: 11px;">Format: JPG, PNG, JPEG</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white py-4 d-flex justify-content-end" style="border-top: 1px solid #f1f5f9;">
                        <button type="submit" class="btn btn-save px-5">
                            <i class="fa fa-check-circle mr-2"></i> Simpan Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Logika Live Preview Gambar
        document.getElementById('imageUpload').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('placeholder-preview');
                
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                if(placeholder) placeholder.style.display = 'none';

                // Update teks label file
                const label = this.nextElementSibling;
                label.innerHTML = file.name;
            }
        };
    </script>
@endsection