<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Toko Sumber Maju - Material Lengkap & Murah</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <link href="{{ asset('user/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">

    <style>
        /* FIX UNTUK NAVBAR MOBILE */
        @media (max-width: 991px) {
            #header {
                background: rgba(15, 23, 42, 0.95) !important; /* Warna Navy Solid di HP */
                padding: 15px 0;
                transition: all 0.5s;
            }

            #nav-menu-container {
                display: none; /* Disembunyikan, akan muncul via script main.js */
            }

            /* Gaya khusus tombol mobile nav jika template menggunakan mobile-nav-toggle */
            #mobile-nav-toggle {
                display: inline;
                position: fixed;
                right: 15px;
                top: 20px;
                z-index: 999;
                border: 0;
                background: none;
                font-size: 24px;
                color: #fff;
            }
            
            #mobile-nav-toggle i {
                color: #fff;
            }
        }

        /* Memastikan Logo Teks terbaca jelas */
        #logo h1 {
            transition: 0.3s;
        }
        
        /* Gaya Scroll */
        #header.header-fixed {
            background: rgba(15, 23, 42, 0.95);
            padding: 10px 0;
            height: 70px;
            transition: all 0.5s;
        }
    </style>

    @yield('header')
</head>

<body>

    <header id="header">
        <div class="container d-flex align-items-center justify-content-between">

            <div id="logo">
                <a href="{{ url('/') }}#hero" class="scrollto" style="display: flex; align-items: center; text-decoration: none; gap: 12px;">
                    <img src="{{ asset('images/logo-icon.jpg') }}" alt="Logo" 
                    style="height: 40px; width: auto; border-radius: 6px;">

                    <div style="display: flex; flex-direction: column; justify-content: center; line-height: 1.1;">
                        <h1 style="margin: 0; font-size: 16px; color: #fff; font-weight: 800; text-transform: uppercase;">
                            TOKO <span style="color: #F26522;">SUMBER MAJU</span>
                        </h1>
                        <span style="font-size: 8px; color: #ccc; letter-spacing: 1px; text-transform: uppercase; opacity: 0.8;">
                            Toko Material Bangunan
                        </span>
                    </div>
                </a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="{{ url('/') }}#hero">Home</a></li>
                    <li><a href="{{ url('/') }}#katalog">Katalog Produk</a></li>
                    <li><a href="{{ url('/') }}#kontak">Lokasi & Kontak</a></li>
                    <li><a href="{{ url('/login') }}" style="color: #F26522; font-weight: bold;">Login Admin</a></li>
                </ul>
            </nav>
            
            {{-- Tombol Hamburger Menu Otomatis biasanya dibuat oleh main.js template ini --}}
            {{-- Jika tidak muncul, pastikan main.js Anda memiliki fungsi mobile nav --}}
        </div>
    </header>

    {{-- Sisanya tetap sama --}}
    <section id="hero">
        <div class="hero-container">
            @yield('hero')
        </div>
    </section>

    <main id="main">
        @yield('content')
    </main>

    <script src="{{ asset('user/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('user/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>

    {{-- Script Tambahan untuk Memastikan Navbar Mobile Berfungsi --}}
    <script>
        $(document).ready(function() {
            // Jika tombol mobile nav belum ada, buat secara dinamis (fallback)
            if ($('#nav-menu-container').length && !$('#mobile-nav-toggle').length) {
                var $mobile_nav = $('#nav-menu-container').clone().prop({
                    id: 'mobile-nav'
                });
                $mobile_nav.find('> ul').attr({
                    'class': '',
                    'id': ''
                });
                $('body').append($mobile_nav);
                $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
                $('body').append('<div id="mobile-body-overly"></div>');

                $(document).on('click', '#mobile-nav-toggle', function(e) {
                    $('body').toggleClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                    $('#mobile-body-overly').toggle();
                });

                $(document).on('click', '#mobile-nav a', function(e) {
                    $('body').removeClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                    $('#mobile-body-overly').fadeOut();
                });
            }
        });
    </script>

</body>
</html>