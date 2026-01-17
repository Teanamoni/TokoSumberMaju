@extends('layouts.admin')

@section('title', 'Tambah Katalog Baru')

@section('breadcrumbs', 'Katalog Produk')

@section('second-breadcrumb')
    <li class="breadcrumb-item active">Tambah Baru</li>
@endsection

@section('css')
    <style>
        /* Modern Card Styling */
        .card-custom {
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.03) !important;
            border: 1px solid #edf2f7;
            overflow: hidden;
        }

        /* Input Styling yang Lebih Soft */
        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            color: #4a5568;
            height: auto;
        }

        .form-control:focus {
            border-color: #f39c12;
            box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
            outline: none;
        }

        /* Fix Select agar tidak "Tenggelam" */
        select.form-control {
            height: 46px !important; /* Tinggi ideal agar teks presisi di tengah */
            cursor: pointer;
        }

        /* Label Styling yang Lebih Elegant */
        label {
            font-weight: 700 !important;
            color: #2d3748;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
        }

        /* Tombol Simpan Modern */
        .btn-success {
            background: linear-gradient(135deg, #2c3e50 0%, #000000 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 12px 25px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(243, 156, 18, 0.2);
        }

        /* Area Preview Gambar */
        .preview-wrapper {
            height: 280px;
            border: 2px dashed #cbd5e0;
            border-radius: 15px;
            background-color: #f7fafc;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .preview-wrapper:hover {
            border-color: #f39c12;
            background-color: #fffaf0;
        }

        #img-preview {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 10px;
            display: none;
        }

        .readonly-input {
            background-color: #f8fafc !important;
            border-style: dashed;
            color: #e67e22 !important;
            font-weight: 800;
            letter-spacing: 1px;
        }

        /* Group Addon Styling */
        .input-group-text {
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            color: #a0aec0;
        }
        
        .input-group-prepend .input-group-text {
            border-right: none;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        .input-group-append .input-group-text {
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card card-custom bg-white">
                    <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #f1f1f1;">
                        <div>
                            <h5 class="m-0 font-weight-bold" style="color: #2c3e50;">
                                <i class="fa fa-plus-circle mr-2 text-warning"></i> Form Tambah Produk
                            </h5>
                            <small class="text-muted">Pastikan data yang diinput sudah sesuai dengan stok fisik.</small>
                        </div>

                        <div>
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-light border px-3 mr-2 shadow-sm" style="border-radius: 8px;">
                                <i class="fa fa-arrow-left mr-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-sm btn-success px-4 shadow-sm">
                                <i class="fa fa-save mr-1"></i> Simpan Katalog
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        <div class="row">
                            {{-- KOLOM KIRI: DATA --}}
                            <div class="col-lg-8 pr-lg-5 border-right">
                                <div class="form-group mb-4">
                                    <label>Kode Produk Ter-Generate</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                                        </div>
                                        <input type="text" name="code" id="autoCode" class="form-control readonly-input" readonly required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Kategori <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Nama Barang <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Contoh: Semen Gresik 50kg" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Stok Tersedia</label>
                                            <div class="input-group">
                                                <input type="number" name="stock" class="form-control" value="0" min="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Unit</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Harga Satuan Jual</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="price" id="priceInput" class="form-control font-weight-bold text-dark" placeholder="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <textarea name="description" rows="5" class="form-control" placeholder="Masukkan detail spesifikasi barang..." required style="resize: none;"></textarea>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: PREVIEW --}}
                            <div class="col-lg-4 pl-lg-4 mt-4 mt-lg-0">
                                <label class="d-block text-center mb-3">Foto Visual Produk</label>
                                
                                <div class="preview-wrapper mb-3">
                                    <div id="placeholder-icon" class="text-center">
                                        <i class="fa fa-image fa-3x text-muted mb-3"></i>
                                        <p class="small text-muted m-0">No Image Selected</p>
                                    </div>
                                    <img id="img-preview" src="" alt="Preview">
                                </div>

                                <div class="custom-file mb-2">
                                    <input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*">
                                    <label class="custom-file-label text-truncate" for="customFile" style="border-radius: 10px;">Pilih File...</label>
                                </div>
                                
                                <div class="mt-4 p-3 info-box rounded border-left border-warning" style="background-color: #fffaf0;">
                                    <p class="small text-dark mb-1"><i class="fa fa-lightbulb mr-1 text-warning"></i> <strong>Tips Foto:</strong></p>
                                    <ul class="small text-muted pl-3 mb-0" style="line-height: 1.6;">
                                        <li>Format: <b>JPEG, JPG, PNG</b>.</li>
                                        <li>Ukuran maksimal: <b>2MB</b>.</li>
                                        <li>Gunakan rasio 1:1 untuk hasil terbaik.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-4 text-right px-lg-5" style="border-top: 1px solid #f1f1f1;">
                        <button type="submit" class="btn btn-success btn-lg shadow px-5">
                            <i class="fa fa-save mr-2"></i> Simpan Data Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Algoritma Generate Kode (Sesuai Permintaan: Tidak Diubah)
            let today = new Date();
            let dateStr = today.getFullYear() +
                String(today.getMonth() + 1).padStart(2, '0') +
                String(today.getDate()).padStart(2, '0');
            let randomNum = Math.floor(100 + Math.random() * 900);
            $('#autoCode').val('PRD-' + dateStr + '-' + randomNum);

            // Algoritma Preview Gambar (Sesuai Permintaan: Tidak Diubah)
            $('#customFile').on('change', function() {
                const file = this.files[0];
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#img-preview').attr('src', e.target.result).fadeIn();
                        $('#placeholder-icon').hide();
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Algoritma Format Rupiah (Sesuai Permintaan: Tidak Diubah)
            $('#priceInput').on('keyup', function() {
                $(this).val(formatRupiah($(this).val()));
            });

            function formatRupiah(angka) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            }
        });
    </script>
@endsection