@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Daftar Produk</h2>
                <div>
                    <button onclick="window.print()" class="btn btn-success me-2">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th class="action-column">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="product-row" style="cursor: pointer;" 
                                data-description="{{ $product->description }}"
                                data-name="{{ $product->name }}">
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="action-column">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Deskripsi Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 id="productName" class="mb-3"></h6>
                <p id="productDescription"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.product-row');
    const modal = new bootstrap.Modal(document.getElementById('descriptionModal'));
    
    rows.forEach(row => {
        row.addEventListener('click', function(e) {
            // Jangan tampilkan modal jika yang diklik adalah tombol atau form
            if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A' || e.target.closest('form')) {
                return;
            }
            
            const description = this.dataset.description || 'Tidak ada deskripsi';
            const name = this.dataset.name;
            
            document.getElementById('productName').textContent = name;
            document.getElementById('productDescription').textContent = description;
            modal.show();
        });
    });
});
</script>
@endpush

<style type="text/css" media="print">
    @media print {
        .navbar, .btn, .action-column, .modal { 
            display: none !important; 
        }
        .card { 
            border: none !important; 
        }
        .card-body { 
            padding: 0 !important; 
        }
        title:after {
            content: "Laporan Daftar Produk" !important;
        }
    }
</style> 