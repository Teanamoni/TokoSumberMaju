@extends('layouts.admin')

@section('title', 'Daftar Kategori')
@section('breadcrumbs', 'Kategori')

@section('css')
<style>
    /* Main Container & Card */
    .content-wrapper {
        background-color: #f8fafc;
    }
    .card-modern {
        border-radius: 24px;
        border: none;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        background: #fff;
    }

    /* Header Styling */
    .card-header-modern {
        background: #fff;
        border-bottom: 1px solid #f1f5f9;
        padding: 25px 30px;
    }
    .header-title {
        color: #0f172a;
        font-weight: 800;
        font-size: 1.25rem;
        margin-bottom: 4px;
    }

    /* Table & Typography */
    .table thead th {
        background-color: #f8fafc;
        color: #94a3b8;
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.2px;
        padding: 18px;
        border: none;
    }
    .table tbody td {
        padding: 20px 18px;
        vertical-align: middle !important;
        border-bottom: 1px solid #f8fafc;
        color: #475569;
        font-size: 14px;
    }
    .table-hover tbody tr:hover {
        background-color: #fcfdfe;
        transform: scale(1.002);
        transition: all 0.2s ease;
    }

    /* Category Visuals */
    .category-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 16px;
        border: 2px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .category-name {
        color: #1e293b;
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 2px;
    }
    .slug-badge {
        background: #f1f5f9;
        color: #64748b;
        padding: 4px 10px;
        border-radius: 8px;
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 12px;
    }

    /* Product Count Badge */
    .count-badge {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #2563eb;
        font-weight: 800;
        padding: 8px 16px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #bfdbfe;
    }

    /* Action Buttons */
    .btn-action-group {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: 0.3s;
        text-decoration: none !important;
    }
    .btn-edit { background: #fef3c7; color: #d97706; }
    .btn-edit:hover { background: #f59e0b; color: #fff; transform: translateY(-2px); }
    
    .btn-delete { background: #fee2e2; color: #dc2626; }
    .btn-delete:hover { background: #ef4444; color: #fff; transform: translateY(-2px); }

    .btn-add-new {
        background: #0f172a;
        color: #fff !important;
        border-radius: 14px;
        padding: 12px 24px;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.15);
        transition: 0.3s;
    }
    .btn-add-new:hover {
        background: #334155;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="container-fluid pb-5">
    <div class="row">
        <div class="col-12">
            <div class="card card-modern">
                
                {{-- Header Section --}}
                <div class="card-header-modern d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="header-title">Manajemen Kategori 📂</h4>
                        <p class="text-muted small m-0">Organisir produk Anda berdasarkan kategori yang tepat.</p>
                    </div>
                    <a href="{{ route('categories.create') }}" class="btn btn-add-new">
                        <i class="fa fa-plus-circle mr-2"></i> Tambah Baru
                    </a>
                </div>

                <div class="card-body p-0">
                    {{-- Alert Notification --}}
                    @if (session('success'))
                        <div class="mx-4 mt-4 alert alert-success border-0 shadow-sm d-flex align-items-center" style="border-radius: 15px; background: #f0fdf4; color: #166534;">
                            <i class="fa fa-check-circle mr-3" style="font-size: 20px;"></i>
                            <span class="font-weight-bold">{{ session('success') }}</span>
                            <button type="button" class="close ml-auto" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 70px;">NO</th>
                                    <th style="width: 100px;">VISUAL</th>
                                    <th>KATEGORI</th>
                                    <th>SLUG</th>
                                    <th class="text-center">JUMLAH PRODUK</th>
                                    <th class="text-center" style="width: 180px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                                        <td>
                                            @if ($category->image)
                                                <img src="{{ asset('category_image/' . $category->image) }}" class="category-img">
                                            @else
                                                <div class="category-img bg-light d-flex align-items-center justify-content-center border">
                                                    <i class="fa fa-tag text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="category-name">{{ $category->name }}</div>
                                            <span class="text-muted small">Updated: {{ $category->updated_at->format('d M Y') }}</span>
                                        </td>
                                        <td>
                                            <span class="slug-badge">{{ $category->slug }}</span>
                                        </td>
                                        
                                        {{-- Hitung Produk Otomatis --}}
                                        <td class="text-center">
                                            <div class="count-badge">
                                                <i class="fa fa-box-open" style="font-size: 12px;"></i>
                                                {{ \App\Product::where('category_id', $category->id)->count() }}
                                                <span style="font-size: 11px; opacity: 0.8;">Barang</span>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-action-group">
                                                <a href="{{ route('categories.edit', [$category->id]) }}" 
                                                   class="btn-action btn-edit" title="Edit Data">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <form id="delete-form-{{ $category->id }}" 
                                                      action="{{ route('categories.destroy', [$category->id]) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-action btn-delete" 
                                                            onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')"
                                                            title="Hapus Kategori">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="py-4">
                                                <i class="fa fa-folder-open text-light mb-3" style="font-size: 60px;"></i>
                                                <h5 class="text-muted font-weight-bold">Belum Ada Kategori</h5>
                                                <p class="text-muted small">Mulai tambahkan kategori pertama Anda untuk mengelompokkan produk.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-0 py-4">
                    {{-- Tempat pagination jika diperlukan nantinya --}}
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
                title: 'Hapus Kategori?',
                html: "Anda akan menghapus kategori <b>" + name + "</b>.<br><small class='text-danger'>Produk di kategori ini akan kehilangan relasinya!</small>",
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