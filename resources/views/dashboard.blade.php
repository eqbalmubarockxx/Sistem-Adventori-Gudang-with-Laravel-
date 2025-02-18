@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary"><i class="fas fa-warehouse me-2"></i>Dashboard Inventori</h2>
                <div class="text-muted">
                    <i class="far fa-clock me-1"></i> {{ date('d M Y') }} <span id="realtime-clock"></span> WIB
                </div>
            </div>
            
            @push('scripts')
            <script>
                function updateClock() {
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0'); 
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    document.getElementById('realtime-clock').textContent = hours + ':' + minutes + ':' + seconds;
                }
                
                // Update setiap detik
                setInterval(updateClock, 1000);
                // Panggil sekali saat load
                updateClock();
            </script>
            @endpush
        </div>
            
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white shadow-sm hover-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title"><i class="fas fa-boxes me-2"></i>Total Produk</h5>
                                    <p class="display-4 mb-0">{{ $totalProducts }}</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-box-open fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-primary-dark text-center">
                            <a href="{{ route('products.index') }}" class="text-white text-decoration-none">
                                <small>Lihat Detail <i class="fas fa-arrow-right ms-1"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card bg-success text-white shadow-sm hover-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title"><i class="fas fa-sign-in-alt me-2"></i>Transaksi Masuk</h5>
                                    <p class="display-4 mb-0">{{ $totalIn }}</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-arrow-circle-down fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-success-dark text-center">
                            <a href="{{ route('transactions.index') }}" class="text-white text-decoration-none">
                                <small>Lihat Detail <i class="fas fa-arrow-right ms-1"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card bg-danger text-white shadow-sm hover-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title"><i class="fas fa-sign-out-alt me-2"></i>Transaksi Keluar</h5>
                                    <p class="display-4 mb-0">{{ $totalOut }}</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-arrow-circle-up fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-danger-dark text-center">
                            <a href="{{ route('transactions.index') }}" class="text-white text-decoration-none">
                                <small>Lihat Detail <i class="fas fa-arrow-right ms-1"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.2s;
}
.hover-card:hover {
    transform: translateY(-5px);
}
.bg-primary-dark {
    background-color: rgba(0,0,0,0.1);
}
.bg-success-dark {
    background-color: rgba(0,0,0,0.1);
}
.bg-danger-dark {
    background-color: rgba(0,0,0,0.1);
}
</style>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection