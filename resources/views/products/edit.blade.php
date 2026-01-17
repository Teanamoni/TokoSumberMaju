@extends('layouts.admin')

@section('title', 'Edit Katalog Produk')
@section('breadcrumbs', 'Katalog Produk')

@section('second-breadcrumb')
    <li class="breadcrumb-item active">Edit Produk</li>
@endsection

@section('css')
    <style>
        /* Modern Card Styling */
        .card-custom {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 35px rgba(0,0,0,0.05) !important;
            overflow: hidden;
            background: #ffffff;
        }

        /* Form Control Enhancement */
        .form-control {
            border-radius: 12px;
            border: 1.5px solid #edf2f7;
            padding: 12px 15px;
            height: auto;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #f39c12;
            box-shadow: 0 0 0 4px rgba(243, 156, 18, 0.1);
            background-color: #fff;
        }

        /* Label Styling */
        label {
            font-weight: 700 !important;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Button Customization */
        .btn-save {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white !important;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(44, 62, 80, 0.2);
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        }

        .btn-back {
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            color: #718096;
            background: #f7fafc;
            border: 1px solid #edf2f7;
        }

        /* Image Preview Box */
        .preview-container {
            border: 2px dashed #e2e8f0;
            border-radius: 20px;
            padding: 15px;
            background: #f8fafc;
            transition: 0.3s;
        }

        .preview-container:hover {
            border-color: #f39c12;
        }

        .img-preview-wrapper {
            width: 100%;
            height: 250px;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
        }

        /* Badge for Readonly */
        .readonly-badge {
            background: #edf2f7;
            color: #4a5568;
            padding: 10px 15px;
            border-radius: 10px;
            font-family: 'Monaco', monospace;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {{-- FORM START --}}
            <form action="{{ route('products.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="card card-custom">
                    {{-- HEADER --}}
                    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-0">
                        <div>
                            <h4 class="m-0 font-weight-bold" style="color: #2c3e50;">
                                <span class="text-warning mr-2">|</span> Edit Detail Produk
                            </h4>
                            <p class="text-muted small m-0 mt-1">Lakukan perubahan pada data katalog barang Anda.</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <a href="{{ route('products.index') }}" class="btn btn-back mr-2">
                                <i class="fa fa-times-circle mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-save shadow-sm">
                                <i class="fa fa-check-circle mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        <div class="row">
                            {{-- KOLOM KIRI: DATA --}}
                            <div class="col-lg-8 pr-lg-5">
                                {{-- 1. KODE BARANG --}}
                                <div class="form-group mb-4">
                                    <label>Kode Inventaris (Read-only)</label>
                                    <div class="readonly-badge border">
                                        <i class="fa fa-lock mr-2 text-muted"></i> {{ $product->code }}
                                        <input type="hidden" name="code" value="{{ $product->code }}">
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- 2. KATEGORI --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Kategori Produk <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- 3. NAMA BARANG --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Nama Barang <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                                   value="{{ old('name', $product->name) }}" placeholder="Nama Lengkap Produk" required>
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- 4. STOK --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Stok Tersedia</label>
                                            <div class="input-group">
                                                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-light border-left-0" style="border-radius: 0 12px 12px 0;">Unit</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- 5. HARGA --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Harga Satuan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; font-weight: bold;">Rp</span>
                                                </div>
                                                <input type="text" name="price" id="priceInput" class="form-control font-weight-bold" 
                                                       value="{{ old('price', (int)$product->price) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 6. DESKRIPSI --}}
                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <textarea name="description" rows="5" class="form-control" placeholder="Tuliskan spesifikasi lengkap produk...">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: GAMBAR --}}
                            <div class="col-lg-4 mt-4 mt-lg-0">
                                <div class="preview-container shadow-sm">
                                    <label class="d-block text-center mb-3">Foto Produk</label>
                                    <div class="img-preview-wrapper border mb-3">
                                        @if ($product->image)
                                            <img id="imgPreview" src="{{ asset('product_image/' . $product->image) }}" 
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div class="text-center text-muted">
                                                <i class="fa fa-image fa-3x mb-2"></i>
                                                <p class="small">Tidak ada foto</p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile" style="border-radius: 10px;">Ganti Foto...</label>
                                    </div>
                                    <p class="small text-muted mt-3 italic text-center">
                                        <i class="fa fa-info-circle mr-1"></i> Format: JPG, PNG. Maks 2MB.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER MOBILE --}}
                    <div class="card-footer bg-light py-4 text-center d-block d-sm-none">
                        <button type="submit" class="btn btn-save btn-block">
                            <i class="fa fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                    
                    {{-- FOOTER DESKTOP (Duplicate for convenience) --}}
                    <div class="card-footer bg-white py-4 px-5 border-top d-none d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-save px-5">
                            <i class="fa fa-save mr-2"></i> Update Data Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Preview Gambar Saat Upload
        $("#customFile").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Format Rupiah logic (Tetap sama sesuai algoritma Anda)
        var priceInput = document.getElementById('priceInput');
        if (priceInput && priceInput.value) {
            priceInput.value = formatRupiah(priceInput.value);
        }

        priceInput.addEventListener('keyup', function(e) {
            this.value = formatRupiah(this.value);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    });
</script>
@endsection