@extends('layouts.admin')

@section('title', 'Daftar Katalog')
@section('breadcrumbs', 'Katalog Produk')

@section('css')
<style>
    /* Card & Container Modernization */
    .card-modern {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.03);
        background: #fff;
        overflow: hidden;
    }
    .card-header-modern {
        background: #fff;
        border-bottom: 1px solid #f1f5f9;
        padding: 25px 30px;
    }

    /* Filter & Search Bar Styling */
    .search-input {
        border-radius: 12px 0 0 12px !important;
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
    }
    .search-btn {
        border-radius: 0 12px 12px 0 !important;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-left: none;
    }
    .filter-select {
        border-radius: 12px !important;
        height: auto !important;
        padding: 10px 15px !important;
        border: 1px solid #e2e8f0;
        font-weight: 600;
        color: #475569;
    }

    /* Table Typography & Visuals */
    .table thead th {
        background-color: #f8fafc;
        color: #94a3b8;
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 18px;
        border: none;
    }
    .table tbody td {
        padding: 20px 15px;
        vertical-align: middle !important;
        border-bottom: 1px solid #f8fafc;
        color: #475569;
    }
    .product-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 14px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .product-name {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0;
        font-size: 15px;
    }
    .product-code {
        font-family: 'Monaco', monospace;
        font-size: 12px;
        color: #94a3b8;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 6px;
    }

    /* Badges & Status */
    .badge-price {
        background: #f0fdf4;
        color: #166534;
        padding: 8px 12px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 14px;
    }
    .badge-category {
        background: #eff6ff;
        color: #2563eb;
        border-radius: 8px;
        padding: 5px 12px;
        font-weight: 600;
    }
    .stock-critical { background: #fee2e2; color: #dc2626; padding: 5px 10px; border-radius: 8px; font-weight: 700; }
    .stock-normal { background: #f0fdf4; color: #16a34a; padding: 5px 10px; border-radius: 8px; font-weight: 700; }

    /* Buttons */
    .btn-add-product {
        background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
        color: white !important;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.1);
        transition: 0.3s;
    }
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        border: none;
    }
    .btn-edit-alt { background: #fef3c7; color: #d97706; }
    .btn-edit-alt:hover { background: #f59e0b; color: white; }
    .btn-delete-alt { background: #fee2e2; color: #dc2626; }
    .btn-delete-alt:hover { background: #ef4444; color: white; }

    /* Pagination Styling */
    .pagination .page-item .page-link { border-radius: 8px; margin: 0 3px; border: none; color: #64748b; font-weight: 600; }
    .pagination .page-item.active .page-link { background: #0f172a; color: white; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-modern">
                
                {{-- Card Header --}}
                <div class="card-header-modern d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                    <div class="mb-3 mb-md-0">
                        <h4 class="m-0 font-weight-bold text-dark">Katalog Produk 📦</h4>
                        <p class="text-muted small m-0">Kelola semua inventaris barang Anda di sini.</p>
                    </div>
                    <a href="{{ route('products.create') }}" class="btn btn-add-product">
                        <i class="fa fa-plus-circle mr-2"></i> Tambah Produk Baru
                    </a>
                </div>

                <div class="card-body">
                    {{-- Alert Notification --}}
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4" style="border-radius: 15px; background: #f0fdf4; color: #166534;">
                            <i class="fa fa-check-circle mr-3" style="font-size: 18px;"></i>
                            <span class="font-weight-bold">{{ session('success') }}</span>
                            <button type="button" class="close ml-auto" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    {{-- Form Pencarian & Filter --}}
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <form action="{{ route('products.index') }}" method="GET" class="form-row align-items-center">
                                <div class="col-md-4 mb-2">
                                    <select name="category_id" class="form-control filter-select shadow-sm" onchange="this.form.submit()">
                                        <option value="">Semua Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                📂 {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group shadow-sm">
                                        <input type="text" name="search" class="form-control search-input" placeholder="Cari Nama atau Kode Produk..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn search-btn" type="submit">
                                                <i class="fa fa-search text-muted"></i>
                                            </button>
                                            @if(request('search'))
                                                <a href="{{ route('products.index') }}" class="btn btn-light border-left-0" style="border-radius: 0 12px 12px 0;">
                                                    <i class="fa fa-times text-danger"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Tabel Data --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th>PRODUK</th>
                                    <th>INFO KATEGORI</th>
                                    <th>HARGA JUAL</th>
                                    <th class="text-center">STOK</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $index => $product)
                                    <tr>
                                        <td class="text-center text-muted small font-weight-bold">
                                            {{ $products->firstItem() + $index }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($product->image)
                                                    <img src="{{ asset('product_image/' . $product->image) }}" class="product-img border mr-3">
                                                @else
                                                    <div class="product-img bg-light d-flex align-items-center justify-content-center border mr-3">
                                                        <i class="fa fa-box text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="product-name">{{ $product->name }}</p>
                                                    <span class="product-code">{{ $product->code ?? 'NO-CODE' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-category">
                                                <i class="fa fa-folder-open mr-1 small"></i>
                                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-price">
                                                Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="{{ ($product->stock ?? 0) <= 5 ? 'stock-critical' : 'stock-normal' }}">
                                                {{ $product->stock }} <small>Stok</small>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('products.edit', [$product->id]) }}" class="btn-action btn-edit-alt" title="Edit Produk">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', [$product->id]) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn-action btn-delete-alt" onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="https://illustrations.popsy.co/gray/box.svg" style="width: 150px; opacity: 0.5;">
                                            <h5 class="mt-3 text-muted">Produk Tidak Ditemukan</h5>
                                            <p class="small text-muted">Coba ganti kata kunci pencarian atau kategori Anda.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted small">
                            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
                        </div>
                        <div>
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Hapus Produk?',
            html: "Barang <b>" + name + "</b> akan dihapus permanen dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'border-radius-20'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection