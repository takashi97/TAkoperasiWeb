<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-oxssT3Wqo8C3q6Uf+6XvR6T2i9mGzDZ+vx6B6RQY8R98QC4oEjhZE4yNKTjNO3sN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Scripts -->

    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Links -->

    <!-- Styles -->
    <style>
    .search-form {
    display: flex;
    align-items: center;
    }

    .search-form input[type="text"] {
    flex: 1;
    margin-right: 10px;
    }

    .search-form button[type="submit"] {
    flex-shrink: 0;
    }

    /* Responsive Styles */
    @media (min-width: 768px) {
    .search-form {
        width: 100%;
        max-width: 2000px;
        margin: 0 auto;
    }
    }
    </style>
    <!-- Styles -->

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Koperasi123
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                    <li class="nav-item">
                    @if (Auth::check() && Auth::user()->level === 'user') 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Daftar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('daftarmember') }}">Daftar Member</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('daftarumkm') }}">Daftar UMKM</a></li>
                        </ul>
                        </li>
                        @endif
                        <!-- Nav item Koperasi Admin -->
                        @if (Auth::check() && Auth::user()->level === 'admin')
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('koperasihomepageadmin') }}">Home</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasihome') }}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasianggota') }}">Anggota</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasisimpan') }}">Simpan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasipinjam') }}">Pinjam</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasipenarikan') }}">Penarikan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasilaporan') }}">Laporan</a></li>
                        </ul>
                        </li>
                        @endif
                        <!-- Nav item Koperasi Admin -->
                         
                        <!-- Nav item Koperasi User -->
                        @if (Auth::check() && (Auth::user()->level === 'umkm' || Auth::user()->level === 'member'))
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Koperasi 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('koperasihomeuser') }}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasisimpanform') }}">Simpan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasipinjamform') }}">Pinjam</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('koperasipenarikanform') }}">Penarikan</a></li>
                        </ul>
                        </li>
                        @endif
                        <!-- Nav item Koperasi User -->

                        <!-- Nav item Marketplace -->
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Marketplace
                        </a>
                        <ul class="dropdown-menu">
                            @if (!Auth::check())
                                <li><a class="dropdown-item" href="{{ url('marketplacehome') }}">Home</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpdashboard') }}">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpkatmakanan') }}">Food</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpkatpakaian') }}">Pakaian</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpkataksesoris') }}">Aksesoris</a></li>
                            @elseif (Auth::user()->level !== 'umkm')
                                <li><a class="dropdown-item" href="{{ url('marketplacehome') }}">Home</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpdashboard') }}">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpkatmakanan') }}">Food</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpkatpakaian') }}">Pakaian</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpkataksesoris') }}">Aksesoris</a></li>
                            @endif
                            @if (Auth::check() && Auth::user()->level !== 'user')
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('mpsellpage') }}">Sell</a></li>
                            @endif
                        </ul>
                        </li>
                        <!-- Nav item Marketplace -->
                    </ul>
                    <div class="text-center">
                        <div class="mx-auto"> <!-- Aligns the element in the middle -->
                        <form action="{{ route('search') }}" method="GET" class="text-center search-form">
                        <input type="text" name="query" placeholder="Search Marketplace..." class="form-control">
                        <button type="submit" class="btn buttontambah"  style="color:white; background-color:rgb(130, 106, 251);"
                        >Search</button>
                        </form>
                        </div>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                    <!-- Nav item Cart -->
                    @if (Auth::check() && (Auth::user()->level === 'umkm' || Auth::user()->level === 'member' || Auth::user()->level === 'user' || Auth::user()->level === 'admin'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('cart') }}"> <i class="bi bi-cart2"></i> Cart </a>
                    </li>
                    @endif
                    <!-- Nav item Cart -->

                    <!-- Nav item Topup -->
                    @if (Auth::check() && (Auth::user()->level === 'umkm' || Auth::user()->level === 'member' || Auth::user()->level === 'user' || Auth::user()->level === 'admin'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Saldo: {{ $saldo }}
                        </a>
                        <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('topupform') }}">Top Up</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('koperasitopup') }}">Riwayat</a></li>
                        </ul>
                    </li>
                    @endif
                    <!-- Nav item Topup -->

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

