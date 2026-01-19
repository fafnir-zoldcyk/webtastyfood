@extends('user.nav')
@section('navbar')

<style>
/* ===============================
   HERO (SAMA DENGAN TENTANG)
=============================== */
.hero-page{
    height:340px;
    background:url('{{ asset("asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/Group 70.png") }}')
               center/cover no-repeat;
    position: relative;
    z-index:1;
    color:#fff;
}

.hero-page::after{
    content:'';
    position:absolute;
    inset:0;
    background: rgba(0,0,0,.55);
    z-index:1;
}

.hero-page .hero-content{
    position: relative;
    z-index:2;
    padding-top:120px; /* OFFSET NAVBAR */
}

/* ===============================
   FORM & CONTENT
=============================== */
.contact-card{
    max-width:1000px;
    margin:auto;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.btn-dark{
    height:48px;
    font-weight:600;
    letter-spacing:.5px;
}

.contact-icon{
    width:56px;
    height:56px;
    background:#000;
    color:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 12px;
    font-size:20px;
}

.map-frame{
    border-radius:16px;
    border:0;
    width:100%;
    height:280px;
}
</style>

{{-- ===============================
    HERO
=============================== --}}
<div class="hero-page">
    <div class="container hero-content">
        <h1 class="fw-bold">KONTAK KAMI</h1>
    </div>
</div>

{{-- ===============================
    FORM
=============================== --}}
<div class="container py-5">
    <div class="card contact-card border-0 p-4">
        <h4 class="fw-bold mb-4">KONTAK KAMI</h4>

        <form action="{{ route('user.kontak.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                    <input type="text" name="name" class="form-control mt-3" placeholder="Name">
                    <input type="email" name="email" class="form-control mt-3" placeholder="Email">
                </div>

                <div class="col-md-6">
                    <textarea rows="6" name="pesan" class="form-control" placeholder="Message"></textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-dark w-100 mt-2">KIRIM</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ===============================
    INFO
=============================== --}}
<div class="container text-center py-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="contact-icon">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <p class="fw-semibold mb-1">EMAIL</p>
            <small>tastyfood@gmail.com</small>
        </div>

        <div class="col-md-4">
            <div class="contact-icon">
                <i class="fa-solid fa-phone"></i>
            </div>
            <p class="fw-semibold mb-1">PHONE</p>
            <small>+62 812 3456 7890</small>
        </div>

        <div class="col-md-4">
            <div class="contact-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <p class="fw-semibold mb-1">LOCATION</p>
            <small>Kota Bandung, Jawa Barat</small>
        </div>
    </div>
</div>

{{-- ===============================
    MAP
=============================== --}}
<div class="container pb-5">
    <iframe
        class="map-frame"
        src="https://www.google.com/maps?q=bandung&output=embed"
        loading="lazy">
    </iframe>
</div>

@endsection