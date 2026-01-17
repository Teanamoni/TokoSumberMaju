<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Bangunan Sumber Maju</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            background: white;
            border-radius: 35px;
            overflow: hidden;
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.15);
            min-height: 620px;
            border: none;
        }

        /* --- SISI KIRI (VISUAL & BRANDING) --- */
        .left-side {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi Elemen Abstrak */
        .left-side::before {
            content: "";
            position: absolute;
            top: -20px;
            right: -20px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(242, 101, 34, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* Styling Logo Anda */
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 18px;
            z-index: 10;
        }

        .logo-image {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 15px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transition: 0.4s;
        }

        .brand-logo:hover .logo-image {
            transform: scale(1.1) rotate(-5deg);
            border-color: #F26522;
        }

        .welcome-content {
            z-index: 10;
        }

        .welcome-content h1 {
            font-weight: 800;
            font-size: 2.8rem;
            color: white;
            line-height: 1.1;
        }

        .welcome-content span {
            color: #F26522;
            text-shadow: 0 0 15px rgba(242, 101, 34, 0.3);
        }

        .welcome-desc {
            color: #94a3b8;
            font-size: 1.05rem;
            margin-top: 1.8rem;
            line-height: 1.7;
            max-width: 90%;
        }

        /* --- SISI KANAN (FORM LOGIN) --- */
        .right-side {
            padding: 4.5rem 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header h3 {
            font-weight: 800;
            font-size: 2rem;
            color: #0f172a;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 14px;
            padding: 14px 18px;
            border: 2px solid #f1f5f9;
            background: #f8fafc;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control:focus {
            background: white;
            border-color: #F26522;
            box-shadow: 0 0 0 4px rgba(242, 101, 34, 0.1);
            transform: translateY(-2px);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            transition: 0.3s;
        }

        .toggle-password:hover { color: #F26522; }

        .btn-login {
            background: linear-gradient(135deg, #F26522 0%, #ff8c52 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            margin-top: 2.5rem;
            transition: all 0.4s;
            box-shadow: 0 10px 25px rgba(242, 101, 34, 0.25);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(242, 101, 34, 0.35);
            filter: brightness(1.1);
        }

        .back-home a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .back-home a:hover { color: #F26522; }

        @media (max-width: 991px) {
            .left-side { display: none; }
            .login-card { max-width: 480px; margin: 1.5rem auto; border-radius: 25px; }
            .right-side { padding: 3rem 2rem; }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="login-card row g-0">
                    
                    <div class="col-lg-6 left-side">
                        <div class="brand-logo">
                            <img src="{{ asset('images/logo-icon.jpg') }}" alt="Logo" class="logo-image">
                            
                            <div class="text-white">
                                <div style="font-weight: 800; letter-spacing: 1.5px; font-size: 1.2rem;">SUMBER MAJU</div>
                                <div style="font-size: 0.75rem; opacity: 0.6; text-transform: uppercase; letter-spacing: 2px;">Building Material</div>
                            </div>
                        </div>

                        <div class="welcome-content">
                            <h1>Membangun <br><span>Masa Depan</span> Lebih Kokoh.</h1>
                            <p class="welcome-desc">Solusi manajemen toko bangunan paling efisien untuk mendukung pertumbuhan bisnis Anda setiap hari.</p>
                        </div>

                        <div class="footer-left small" style="color: rgba(255,255,255,0.3)">
                            &copy; 2026 Sumber Maju System v2.0
                        </div>
                    </div>

                    <div class="col-lg-6 right-side">
                        <div class="login-header mb-5">
                            <h3>Welcome !</h3>
                            <p class="text-muted">Gunakan akun admin Anda untuk mengelola toko.</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Email / Username</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" placeholder="admin@sumbermaju.com" required autofocus>
                                @error('email')
                                    <div class="text-danger mt-2 small fw-bold"><i class="fa fa-exclamation-circle me-1"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-decoration-none small fw-bold" style="color: #F26522;">Lupa Password?</a>
                                    @endif
                                </div>
                                <div class="password-wrapper">
                                    <input type="password" id="password" class="form-control" 
                                           name="password" placeholder="••••••••" required>
                                    <i class="fa fa-eye toggle-password" onclick="togglePassword()"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn-login">
                                Sign In Dashboard <i class="fa fa-arrow-right ms-2"></i>
                            </button>
                        </form>

                        <div class="back-home text-center mt-4">
                            <a href="{{ url('/') }}"><i class="fa fa-chevron-left me-2"></i> Kembali ke Website Utama</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>