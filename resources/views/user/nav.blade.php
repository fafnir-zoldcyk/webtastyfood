<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tasty Food</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        /* ===============================
        GLOBAL
        ================================*/
        body{
            font-family:'Poppins', sans-serif;
            background:#F2F2F2;
            color:#333;
            margin:0;
            padding:0;
        }
        .body-class{
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        /* ===============================
        NAVBAR
        ================================*/
        .navbar{
            background:transparent;
            padding:25px 0;
            position:fixed;
            width:100%;
            z-index:10;
            transition: background-color .3s ease, box-shadow .3s ease;
        }

        /* Navbar teks default putih sebelum scroll */
        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #fff !important;
            transition: color .3s ease, transform .3s ease;
        }

        /* Hover efek untuk link navbar */
        .navbar .nav-link:hover {
            color: #dbdbdb !important;
            transform: translateY(-2px);
        }

        /* Navbar saat scrolled */
        .navbar.scrolled {
            background: #ffffff !important;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }

        .navbar.scrolled .nav-link,
        .navbar.scrolled .navbar-brand {
            color: #333 !important;
        }

        .navbar.scrolled .nav-link:hover {
            color: #1F2933 !important;
        }

        .navbar-brand{
            font-size:22px;
            font-weight:700;
        }
        .nav-link{
            font-size:14px;
            letter-spacing:1px;
            font-weight:500;
        }
        /* ===============================
            NAVBAR AUTH BUTTON
        =================================*/
        /* AUTH BUTTON - DEFAULT (navbar transparan) */
        .nav-auth-btn {
            border: 1.5px solid #fff;
            padding: 8px 22px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            background: transparent;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .nav-auth-btn:hover {
            background: #fff;
            color: #000 !important;
        }
        /* AUTH BUTTON - NAVBAR SCROLLED */
        .navbar.scrolled .nav-auth-btn {
            border-color: #000;
            color: #000 !important;
        }

        .navbar.scrolled .nav-auth-btn:hover {
            background: #000;
            color: #fff !important;
        }
        /* ===============================
   PROFILE ICON (LOGIN)
=================================*/
.nav-profile-left .profile-icon{
    width:40px;
    height:40px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition: all .3s ease;
}

/* NAVBAR TRANSPARAN (BELUM SCROLL) */
.navbar:not(.scrolled) .nav-profile-left .profile-icon{
    border:2px solid #fff;
    background:transparent;
}

.navbar:not(.scrolled) .nav-profile-left .profile-icon i{
    color:#fff;
    font-size:18px;
}

/* NAVBAR SETELAH SCROLL */
.navbar.scrolled .nav-profile-left .profile-icon{
    border:2px solid #000;
    background:#fff;
}

.navbar.scrolled .nav-profile-left .profile-icon i{
    color:#000;
    font-size:18px;
}

/* HOVER */
.nav-profile-left .profile-icon:hover{
    transform: scale(1.08);
}
.navbar.scrolled .dropdown img {
    border-color: #000 !important;
}




        /* ===============================
        HERO / CONTENT
        ================================*/
        .home-hero{
            min-height:100vh;
            display:flex;
            align-items:center;
            background:#F2F2F2;
            position:relative;
            overflow:hidden;
        }

        .hero-title{
            position: relative;
            font-size:52px;
            font-weight:700;
            line-height:1.2;
            color:#ffffff;
        }
        .hero-text p{
            max-width:420px;
            color:#555;
        }

        .hero-img{
            position:absolute;
            right:-190px;
            top:214px;
            transform:translateY(-50%);
            max-height:120vh;
            width:auto;
            z-index:1;
        }

        .hero-bg{
            height:70vh;
            background-size:cover;
            background-position:center;
            position:relative;
            display:flex;
            align-items:center;
        }
        .hero-bg::after{
            content:''; 
            position:absolute;
            inset:0;
            background:#F2F2F2;
            opacity:0.9;
        }
        .hero-bg h1{
            position:relative;
            z-index:2;
            font-size:48px;
            font-weight:700;
            color:#222;
        }

        .about-home{
            padding:80px 0;
            background:#fff;
        }

        .divider-line{
            width:400px;
            height:2px;
            background:#000;
            margin:30px auto 0;
        }

        .food-section {
            background: url('{{ asset("asset/gambar/Group 70@2x.png") }}') center/cover no-repeat;
            padding: 100px 0;
        }

        .food-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 60px 20px 30px;
            text-align: center;
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,.15);
        }

        .food-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid #fff;
        }

        .food-card h5 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .food-card p {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 0;
        }

        .card img {
            object-fit: cover;
            height: 200px;
        }
        .card-utama img {
            height: 300px;
        }
        .read-more {
            color: #ff9800;
            font-weight: 500;
            text-decoration: none;
        }

        .galeri-img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 6px 16px rgba(0,0,0,.15);
        }

        .btn-galeri {
            background: #000;
            color: #fff;
            padding: 12px 40px;
            border-radius: 0;
            font-weight: 600;
            letter-spacing: .5px;
        }
        .btn-galeri:hover {
            background: #222;
            color: #fff;
        }

        /* ===============================
        FOOTER
        ================================*/
        .footer-dark {
            background: radial-gradient(circle at top, #1b1b1b, #000);
            color: #fff;
        }

        .footer-dark p {
            line-height: 1.8;
        }

        .footer-link li {
            margin-bottom: 8px;
        }

        .footer-link a {
            color: #bdbdbd;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-link a:hover {
            color: #fff;
        }

        .footer-contact li {
            color: #bdbdbd;
            font-size: 14px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
        }
        .social-icon.facebook { background: #3b5998; }
        .social-icon.twitter { background: #1da1f2; }
        .social-icon:hover { opacity: 0.85; }

        /* RESPONSIVE */
        @media (max-width: 991px){
            .hero-img{
                position:static;
                transform:none;
                max-height:320px;
                margin:30px auto 0;
                display:block;
            }

            .home-hero{
                padding-top:120px;
                text-align:center;
            }

            .hero-text p{
                margin-left:auto;
                margin-right:auto;
            }
        }
    </style>
</head>
<body class="body-class">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- LOGO -->
        <a class="navbar-brand text-white fw-bold" href="/" style="font-size:22px; letter-spacing:1px;">
            TASTY FOOD
        </a>

        <!-- MENU & PROFILE -->
        <div class="d-flex align-items-center">

            <!-- MENU NAV -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item"><a class="nav-link text-white" href="/">HOME</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/tentang">TENTANG</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/berita">BERITA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('user.gallery') }}">GALERI</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('user.kontak') }}">KONTAK</a></li>
                </ul>
            </div>

            <!-- PROFILE FOTO DROPDOWN -->
            <!-- PROFILE ICON -->
<div class="nav-item dropdown ms-4">

    @auth
        <!-- SAAT LOGIN -->
        <a href="#" id="profileDropdown"
           class="nav-link p-0"
           data-bs-toggle="dropdown"
           aria-expanded="false">

            <img
                src="{{ empty(Auth::user()->profile)
                    ? asset('asset/food/user.png')
                    : asset('storage/profile/'.Auth::user()->profile) }}"
                alt="Profile"
                class="rounded-circle"
                style="
                    width:40px;
                    height:40px;
                    object-fit:cover;
                    border:2px solid #fff;
                    cursor:pointer;
                ">
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
                <a class="dropdown-item" href="/profile">
                    <i class="fa fa-user me-2"></i> Profile
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="GET" class="m-0">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fa fa-right-from-bracket me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

    @else
        <!-- SAAT LOGOUT -->
        <a href="{{ route('admin.login') }}"
           class="profile-icon"
           title="Login">
            <i class="fa fa-user"></i>
        </a>
    @endauth

</div>

            <!-- TOGGLER MOBILE -->
            <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </div>
</nav>


    {{-- HERO BACKGROUND (KHUSUS PAGE SELAIN HOME) --}}
@if (View::hasSection('hero-bg'))
<section class="hero-bg"
    style="background-image: url('@yield('hero-bg')');">
    <div class="container">
        <h1>@yield('hero-title')</h1>
    </div>
</section>
@endif
{{-- CONTENT --}}
@yield('navbar')

    {{-- FOOTER --}}
    <footer class="footer-dark pt-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold text-white mb-3">Tasty Food</h5>
                    <p class="text-white small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white fw-semibold mb-3">Useful links</h6>
                    <ul class="list-unstyled footer-link">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Hewan</a></li>
                        <li><a href="#">Galeri</a></li>
                        <li><a href="#">Testimonial</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white fw-semibold mb-3">Privacy</h6>
                    <ul class="list-unstyled footer-link">
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak Kami</a></li>
                        <li><a href="#">Servis</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="text-white fw-semibold mb-3">Contact Info</h6>
                    <ul class="list-unstyled footer-contact">
                        <li><i class="fas fa-envelope"></i> tastyfood@gmail.com</li>
                        <li><i class="fas fa-phone"></i> +62 812 3456 7890</li>
                        <li><i class="fas fa-map-marker-alt"></i> Kota Bandung, Jawa Barat</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <p class="text-center text-muted small mb-0">
                Copyright ©2023 All rights reserved
            </p>
        </div>
    </footer>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', () => {
            if(window.scrollY > 50){
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
