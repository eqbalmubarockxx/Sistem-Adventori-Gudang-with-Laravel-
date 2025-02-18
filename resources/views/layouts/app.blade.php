<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar {
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover:after {
            width: 80%;
        }
        .dropdown-menu {
            animation: fadeIn 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .dropdown-item {
            transition: all 0.2s ease;
            padding: 0.7rem 1.5rem;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Footer Styles */
        .footer {
            background-color: #212529;
            color: #fff;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        .footer h5 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .footer-links {
            list-style: none;
            padding: 0;
        }
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-links a:hover {
            color: #fff;
        }
        .social-links a {
            color: #fff;
            margin-right: 1rem;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
            display: inline-block;
        }
        .social-links a:hover {
            transform: translateY(-3px);
        }
        .footer-bottom {
            background-color: #1a1e21;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-warehouse me-2"></i>Inventori Gudang
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-line me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="fas fa-box me-1"></i>Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="fas fa-tags me-1"></i>Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                            <i class="fas fa-exchange-alt me-1"></i>Transaksi
                        </a>
                    </li>
                </ul>
                
                @auth
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5><i class="fas fa-warehouse me-2"></i>Inventori Gudang</h5>
                    <p class="text-muted">
                        Sistem manajemen inventori yang memudahkan pengelolaan stok barang di gudang Anda.
                        Kelola produk, kategori, dan transaksi dengan lebih efisien.
                    </p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5>Menu Utama</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('dashboard') }}"><i class="fas fa-chart-line me-2"></i>Dashboard</a></li>
                        <li><a href="{{ route('products.index') }}"><i class="fas fa-box me-2"></i>Produk</a></li>
                        <li><a href="{{ route('categories.index') }}"><i class="fas fa-tags me-2"></i>Kategori</a></li>
                        <li><a href="{{ route('transactions.index') }}"><i class="fas fa-exchange-alt me-2"></i>Transaksi</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-phone me-2"></i>+6285156433746</li>
                        <li><i class="fas fa-envelope me-2"></i>PTMencariCintaSejati@gmail.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Babakan Sari No.68 Kec. Kiaracondong, Kota Bandung</li>
                    </ul>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <div class="container">
                <p class="mb-0">&copy;{{ date('Y') }} PT Mencari Cinta Sejati.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 