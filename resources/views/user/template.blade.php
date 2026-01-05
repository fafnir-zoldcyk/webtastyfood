<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Tasty Food')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
    /* ===============================
    GLOBAL
    =================================*/
    body{
        font-family:'Poppins', sans-serif;
        background:#F2F2F2;
        color:#333;
        margin:0;
        padding:0;
    }

/* ===============================
   NAVBAR
=================================*/
.navbar{
    background:transparent;
    padding:25px 0;
    position:fixed;
    width:100%;
    z-index:10;
}
.navbar-brand{
    color:#000 !important;
    font-size:22px;
    /* letter-spacing:1.5px; */
    font-weight:700;
}
.nav-link{
    color:#333 !important;
    font-size:14px;
    letter-spacing:1px;
    font-weight:500;
}
/* NAVBAR SCROLL EFFECT */
.navbar {
    transition: background-color .3s ease, box-shadow .3s ease;
}

.navbar.scrolled {
    background: #ffffff !important;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

/* DEFAULT (HALAMAN SELAIN HOME) */
        .navbar-inner{
            justify-content:space-between;
        }

        /* KHUSUS HOME */
        .home-page .navbar-inner{
            justify-content:flex-start;
        }

        .home-page .navbar-nav{
            margin-left:40px;
        }


/* ===============================
   HOME HERO
=================================*/
.home-hero{
    min-height:100vh;
    display:flex;
    align-items:center;
    background:#F2F2F2;
    position:relative;
    overflow:hidden;
}

/* TEXT */
.hero-title{
    position: relative;
    font-size:52px;
    font-weight:700;
    line-height:1.2;
    color:#222;
}
/* .hero-title::before{
    content:"";
    position: absolute;
    top: 0;
    left: 0;
    width:50px;
    height:4px;
    background:#000000;
    margin-bottom:16px;
} */
.hero-text p{
    max-width:420px;
    color:#555;
}

/* IMAGE RIGHT (FULL EDGE) */
.hero-img{
    position:absolute;
    right:-190px;
    top:214px;
    transform:translateY(-50%);
    max-height:120vh;
    width:auto;
    z-index:1;
}

   /* HERO BACKGROUND (PAGE LAIN) */
.hero-bg{
    height:70vh;
    background-size:cover;
    background-position:center;
    position:relative;
    display:flex;
    align-items:center;
}

/* OVERLAY PUTIH KEABUAN */
.hero-bg::after{
    content:'';
    position:absolute;
    inset:0;
    background:#F2F2F2;
    opacity:0.9;
}

/* TITLE */
.hero-bg h1{
    position:relative;
    z-index:2;
    font-size:48px;
    font-weight:700;
    color:#222;
}
/* tentang */
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
/* makanan */
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

        /* berita */
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

        /* galeri */
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

        /* footer */
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

        .social-icon.facebook {
            background: #3b5998;
        }

        .social-icon.twitter {
            background: #1da1f2;
        }

        .social-icon:hover {
            opacity: 0.85;
        }
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
<body class="@yield('body-class')">

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold me-4" href="/">TASTY FOOD</a>

            <ul class="navbar-nav flex-row gap-4">
                <li class="nav-item"><a class="nav-link" href="/">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="/tentang">TENTANG</a></li>
                <li class="nav-item"><a class="nav-link" href="/berita">BERITA</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.gallery') }}">GALERI</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.kontak') }}">KONTAK</a></li>
            </ul>
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
@yield('content')

{{-- footer --}}
<footer class="footer-dark pt-5">
    <div class="container">
        <div class="row gy-4">

            {{-- BRAND --}}
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold text-white mb-3">Tasty Food</h5>
                <p class="text-white small">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>

                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="social-icon facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-icon twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                </div>
            </div>

            {{-- USEFUL LINKS --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-semibold mb-3">Useful links</h6>
                <ul class="list-unstyled footer-link">
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Hewan</a></li>
                    <li><a href="#">Galeri</a></li>
                    <li><a href="#">Testimonial</a></li>
                </ul>
            </div>

            {{-- PRIVACY --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-semibold mb-3">Privacy</h6>
                <ul class="list-unstyled footer-link">
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                    <li><a href="#">Servis</a></li>
                </ul>
            </div>

            {{-- CONTACT INFO --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="text-white fw-semibold mb-3">Contact Info</h6>
                <ul class="list-unstyled footer-contact">
                    <li>
                        <i class="bi bi-envelope"></i>
                        tastyfood@gmail.com
                    </li>
                    <li>
                        <i class="bi bi-telephone"></i>
                        +62 812 3456 7890
                    </li>
                    <li>
                        <i class="bi bi-geo-alt"></i>
                        Kota Bandung, Jawa Barat
                    </li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <p class="text-center text-muted small mb-0">
            Copyright ©2023 All rights reserved
        </p>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

</body>
</html>
