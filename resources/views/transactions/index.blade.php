@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Daftar Transaksi</h2>
                <div>
                    <button onclick="window.print()" class="btn btn-success me-2">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Transaksi
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('transactions.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Tipe Transaksi</label>
                                <select name="type" class="form-select">
                                    <option value="">Semua Tipe</option>
                                    <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Masuk</option>
                                    <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Keluar</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cari Produk</label>
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nama produk...">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-undo"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Tanggal</th>
                                <th>Tipe</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>User</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $transaction->type == 'in' ? 'success' : 'danger' }}">
                                        {{ $transaction->type == 'in' ? 'Masuk' : 'Keluar' }}
                                    </span>
                                </td>
                                <td>{{ $transaction->product->name }}</td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->notes }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $transaction->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" 
                                        class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $transaction->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Tipe Transaksi</label>
                                                    <select class="form-control" name="type" required>
                                                        <option value="in" {{ $transaction->type == 'in' ? 'selected' : '' }}>Barang Masuk</option>
                                                        <option value="out" {{ $transaction->type == 'out' ? 'selected' : '' }}>Barang Keluar</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Produk</label>
                                                    <select class="form-control" name="product_id" required>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}" 
                                                                {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                                                                {{ $product->name }} (Stok: {{ $product->stock }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Jumlah</label>
                                                    <input type="number" class="form-control" name="quantity" 
                                                        value="{{ $transaction->quantity }}" required min="1">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Catatan</label>
                                                    <textarea class="form-control" name="notes">{{ $transaction->notes }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css" media="print">
    @media print {
        .navbar, .btn, form { 
            display: none !important; 
        }
        .card { 
            border: none !important; 
        }
        .card-body { 
            padding: 0 !important; 
        }
        title:after {
            content: "Laporan Transaksi" !important;
        }
        .badge {
            border: 1px solid #000 !important;
            color: #000 !important;
            background-color: transparent !important;
        }
    }
</style>
@endsection