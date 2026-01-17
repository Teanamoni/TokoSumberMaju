<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('ElaAdmin/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('ElaAdmin/css/style.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* --- GLOBAL & RESET --- */
        body {
            font-family: 'Nunito', sans-serif !important;
            background: #f4f6f9 !important;
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
            min-height: 100vh !important;
            width: 100% !important;
            overflow-x: hidden;
        }

        html {
            height: 100%;
        }

        /* --- 1. SIDEBAR DESKTOP --- */
        aside.left-panel {
            background: #2c3e50 !important;
            width: 280px;
            position: fixed !important;
            top: 0;
            bottom: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            overflow-y: hidden;
            border: none !important;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1) !important;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Header Sidebar */
        .sidebar-header-box {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background: #243342;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .sidebar-brand-text {
            color: #fff !important;
            font-weight: 800;
            font-size: 22px;
            display: flex;
            align-items: center;
            text-decoration: none !important;
            white-space: nowrap;
            overflow: hidden;
        }

        /* Tombol Hamburger */
        .sidebar-toggle-btn {
            color: #fff !important;
            cursor: pointer;
            font-size: 20px;
            padding: 5px;
        }

        .sidebar-toggle-btn:hover {
            color: #f39c12 !important;
        }

        /* Menu Navigation Styling */
        .navbar {
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            margin-top: 20px;
        }

        /* Menu Items */
        .navbar .navbar-nav li>a {
            color: #ecf0f1 !important;
            font-weight: 600 !important;
            padding: 15px 25px !important;
            display: flex;
            align-items: center;
        }

        .navbar .navbar-nav li>a .menu-icon {
            color: #bdc3c7 !important;
            width: 30px;
            text-align: left;
            font-size: 16px;
        }

        .navbar .navbar-nav li>a:hover {
            color: #f39c12 !important;
            background: rgba(255, 255, 255, 0.05);
        }

        /* Active State */
        .navbar .navbar-nav li.active {
            background: transparent !important;
            border-left: 4px solid #f39c12 !important;
        }

        .navbar .navbar-nav li.active>a {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.05) !important;
        }

        .navbar .navbar-nav li.active>a .menu-icon {
            color: #f39c12 !important;
        }

        /* --- FIX SUB-MENU VISIBILITY --- */
        .navbar .navbar-nav li .sub-menu {
            background: rgba(0, 0, 0, 0.2) !important; /* Slightly darker than sidebar */
            padding: 5px 0 !important;
            border: none !important;
        }

        .navbar .navbar-nav li .sub-menu li {
            background: transparent !important;
            border: none !important;
        }

        .navbar .navbar-nav li .sub-menu li a {
            color: #bdc3c7 !important;
            padding: 10px 15px 10px 55px !important; /* Indented with icon space */
            font-size: 14px;
            background: transparent !important;
            display: block;
        }

        .navbar .navbar-nav li .sub-menu li a:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.05) !important;
        }

        .navbar .navbar-nav li .sub-menu li.active a {
            color: #f39c12 !important;
            font-weight: 700;
            background: transparent !important;
        }
        
        /* Icon adjustments in sub-menu */
        .navbar .navbar-nav li .sub-menu li a i {
            margin-right: 10px;
            font-size: 12px;
            width: 15px;
            text-align: center;
        }


        /* --- 2. MAIN CONTENT (RIGHT PANEL) --- */
        #right-panel {
            margin-left: 280px;
            transition: all 0.3s ease;
        }

        /* --- HEADER ATAS (UPDATE BARU) --- */
        #header {
            background: #fff !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05) !important;
            margin-bottom: 25px;
            /* Jarak ke konten bawah */
            height: 70px;
            display: flex;
            align-items: center;
            /* PERUBAHAN: Space Between agar Judul di Kiri, Profile di Kanan */
            justify-content: space-between !important;
            padding: 0 30px;
            z-index: 990;
        }

        /* Style untuk Judul di Header */
        .header-title-text {
            font-size: 24px;
            font-weight: 800;
            color: #2c3e50;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .desktop-logo-container {
            display: none;
        }

        /* Breadcrumbs lama kita hilangkan/hide */
        .breadcrumbs {
            display: none !important;
        }

        .mobile-nav-bar {
            display: none !important;
        }


        /* --- LOGIKA HAMBURGER (MINI SIDEBAR) --- */
        body.mini-sidebar aside.left-panel {
            width: 80px;
        }

        body.mini-sidebar #right-panel {
            margin-left: 80px;
        }

        body.mini-sidebar .sidebar-brand-text span {
            display: none;
        }

        body.mini-sidebar .sidebar-brand-text i {
            font-size: 24px;
            margin: 0;
        }

        body.mini-sidebar .navbar .navbar-nav li>a span {
            display: none;
        }

        body.mini-sidebar .navbar .navbar-nav li>a {
            justify-content: center;
            padding: 15px 0 !important;
        }

        body.mini-sidebar .navbar .navbar-nav li>a .menu-icon {
            margin: 0;
            text-align: center;
            font-size: 20px;
        }

        body.mini-sidebar .sidebar-header-box {
            padding: 0 10px;
            justify-content: center;
            flex-direction: column;
        }

        body.mini-sidebar .sidebar-toggle-btn {
            margin-top: 5px;
        }


        /* --- RESPONSIVE MOBILE (HP - MAX 768px) --- */
        @media (max-width: 768px) {
            body {
                display: block !important;
                padding-top: 0 !important;
            }

            aside.left-panel {
                display: none !important;
            }

            #right-panel {
                margin-left: 0 !important;
                padding-top: 0 !important;
                margin-top: 0 !important;
            }

            #header {
                display: flex !important;
                flex-direction: column !important;
                height: auto !important;
                padding: 0 !important;
                margin: 0 !important;
                justify-content: center !important;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05) !important;
                background: #fff !important;
                position: relative;
            }

            .desktop-logo-container {
                display: flex;
                width: 100%;
                justify-content: center;
                align-items: center;
                padding: 15px 0;
                border-bottom: 1px solid #f9f9f9;
            }

            .mobile-brand-text {
                font-size: 20px !important;
                margin: 0 !important;
                color: #2c3e50 !important;
                font-weight: 800;
                display: flex;
                align-items: center;
                text-decoration: none !important;
            }

            .top-right {
                display: none !important;
            }

            /* Di Mobile, menu diatur di bawah logo */
            .mobile-nav-bar {
                display: flex !important;
                justify-content: space-around;
                align-items: center;
                padding: 8px 0;
                list-style: none;
                margin: 0;
                width: 100%;
                background: #fff;
            }

            .mobile-nav-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-decoration: none !important;
                color: #95a5a6;
                font-size: 10px;
                font-weight: 700;
                width: 70px;
            }

            .mobile-nav-item i {
                font-size: 18px;
                margin-bottom: 4px;
                color: #b0b8bf;
            }

            .mobile-nav-item.active {
                color: #2c3e50 !important;
            }

            .mobile-nav-item.active i {
                color: #f39c12 !important;
            }

            .mobile-profile-img {
                width: 22px;
                height: 22px;
                border-radius: 50%;
                border: 2px solid #eee;
                object-fit: contain;
                margin-bottom: 2px;
            }

            .mobile-nav-item:hover .mobile-profile-img {
                border-color: #f39c12;
            }

            .content {
                padding: 15px !important;
                margin-top: 0 !important;
            }
            /* --- PERBAIKAN DROPDOWN PROFIL MOBILE --- */
            .mobile-nav-bar li.dropdown {
                position: relative !important;
            }

            .mobile-dropdown-fix {
            position: absolute !important;
            bottom: 100% !important; /* Memaksa ke atas */
            top: auto !important;
            right: 0 !important;
            transform: none !important; /* Mengunci posisi agar tidak diatur otomatis oleh Bootstrap */
            margin-bottom: 15px !important;
}
                
                /* Styling Box */
                min-width: 180px;
                background: #fff;
                border: none;
                border-radius: 12px;
                box-shadow: 0 -5px 20px rgba(0,0,0,0.15);
                padding: 8px 0;
                z-index: 9999;
            }

            /* Efek Panah Segitiga */
            .mobile-dropdown-fix::after {
                content: "";
                position: absolute;
                bottom: -8px;
                right: 20px;
                border-width: 8px 8px 0 8px;
                border-style: solid;
                border-color: #fff transparent transparent transparent;
            }

            .mobile-dropdown-fix .dropdown-item {
                padding: 12px 20px;
                font-weight: 600;
                font-size: 14px;
                color: #2c3e50;
            }

            .mobile-dropdown-fix .dropdown-divider {
                margin: 5px 0;
            }
        }
    </style>
    @yield('css')
</head>

<body>
    <aside id="left-panel" class="left-panel">
        <div class="sidebar-header-box">
            <a href="{{ url('admin/dashboard') }}" class="sidebar-brand-text" style="display: flex; align-items: center; text-decoration: none;">
                <img src="{{ asset('images/logo-icon.jpg') }}" alt="Logo" style="height: 40px; margin-right: 10px;">
                <div style="display: flex; flex-direction: column; justify-content: center; line-height: 1.2;">
                    <span style="font-size: 18px; font-weight: 800; color: #fff; text-transform: uppercase;">SUMBER MAJU</span>
                    <span style="font-size: 10px; font-weight: 400; color: #ccc; letter-spacing: 0.5px;">Toko Bangunan Terlengkap</span>
                </div>
            </a>
            <div id="menuToggle" class="sidebar-toggle-btn"><i class="fa fa-bars"></i></div>
        </div>

        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="menu-icon fa fa-th-large"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item-has-children dropdown {{ Request::is('admin/products*') || Request::is('admin/categories*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-cubes"></i>
                            <span>Kelola Barang</span>
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                                <a href="{{ url('admin/products') }}">
                                    <i class="fa fa-list-ul"></i> Produk
                                </a>
                            </li>
                            <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                                <a href="{{ url('admin/categories') }}">
                                    <i class="fa fa-tags"></i> Kategori
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings') }}">
                            <i class="menu-icon fa fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/abouts*') ? 'active' : '' }}">
                        <a href="{{ url('admin/abouts') }}">
                            <i class="menu-icon fa fa-info-circle"></i>
                            <span>Tentang Toko</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <div id="right-panel" class="right-panel">

        <header id="header" class="header">

    <div class="header-title d-none d-md-block">
        <h4 class="header-title-text">@yield('breadcrumbs')</h4>
    </div>

    <div class="desktop-logo-container">
        <a href="{{ url('admin/dashboard') }}" class="mobile-brand-text" style="display: flex; align-items: center; text-decoration: none;">
            <img src="{{ asset('images/logo-icon.jpg') }}" alt="Logo" style="height: 35px; margin-right: 10px;">
            <div style="display: flex; flex-direction: column; justify-content: center; line-height: 1.2; text-align: left;">
                <span style="font-size: 16px; font-weight: 800; color: #2c3e50; text-transform: uppercase;">SUMBER MAJU</span>
                <span style="font-size: 9px; font-weight: 500; color: #7f8c8d; letter-spacing: 0.5px;">Toko Bangunan Terlengkap</span>
            </div>
        </a>
    </div>

    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->avatar)
                        <img class="user-avatar rounded-circle" src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt="User Avatar" style="width: 40px; height: 40px; object-fit: contain;">
                    @else
                        <img class="user-avatar rounded-circle" src="{{ asset('ElaAdmin/images/admin.jpg') }}" alt="User Avatar">
                    @endif
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('admin.settings') }}">
                        <i class="fa fa-cog mr-2"></i> Pengaturan Profil
                    </a>
                    <a class="nav-link" href="#" onclick="logout(event)"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <ul class="mobile-nav-bar">
    <li>
        <a href="{{ url('admin/dashboard') }}" class="mobile-nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <i class="fa fa-th-large"></i> <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ url('admin/products') }}" class="mobile-nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
            <i class="fa fa-list-ul"></i> <span>Produk</span>
        </a>
    </li>
    <li>
        <a href="{{ url('admin/categories') }}" class="mobile-nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}">
            <i class="fa fa-tags"></i> <span>Kategori</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.settings') }}" class="mobile-nav-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
            <i class="fa fa-cog"></i> <span>Setting</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="mobile-nav-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (Auth::user()->avatar)
                <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" class="mobile-profile-img" alt="Profil">
            @else
                <img src="{{ asset('ElaAdmin/images/admin.jpg') }}" class="mobile-profile-img" alt="Profil">
            @endif
            <span>Profil</span>
        </a>
        <div class="dropdown-menu mobile-dropdown-fix">
            <a class="dropdown-item" href="{{ route('admin.settings') }}">
                <i class="fa fa-cog mr-2"></i> Pengaturan Profil
            </a>
            <div class="dropdown-divider"></div> 
            <a class="dropdown-item text-danger" href="#" onclick="logout(event)">
                <i class="fa fa-power-off mr-2"></i> Logout
            </a>
        </div>
    </li>
</ul>
</header>

        <div class="content">
            <div class="animated fadeIn">
                @yield('content')
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{ asset('ElaAdmin/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        function logout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan keluar dari sesi ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2c3e50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                borderRadius: '10px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // 1. Submit form logout
                    document.getElementById('logout-form').submit();
                    
                    // 2. Redirect ke login (opsional karena Laravel biasanya otomatis redirect)
                    setTimeout(function() {
                        window.location.href = "{{ route('login') }}"; 
                    }, 500);
                }
            }); // <-- Tanda ini tadi kurang
    } // <-- Tanda ini tadi kurang

    jQuery(document).ready(function($) {
        $('#menuToggle').on('click', function(event) {
            event.preventDefault();
            $('body').toggleClass('mini-sidebar');
        });
    });
</script>
    @yield('scripts')
</body>

</html>
