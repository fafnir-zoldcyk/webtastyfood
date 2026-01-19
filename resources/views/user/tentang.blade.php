@extends('user.nav')

@section('title','Tentang Kami')

@section('navbar')

<style>
/* ================= HERO TENTANG ================= */
.hero-tentang{
    height:500px;
    background:url('{{ asset("asset/gambar/Group 70.png") }}') center/cover no-repeat;
    position: relative;
    z-index: 1;
}
.hero-tentang::after{
    content:'';
    position:absolute;
    inset:0;
    background: rgba(0,0,0,.55);
    z-index: 1;
}
.hero-tentang .hero-content{
    position: relative;
    z-index: 2;
    padding-top: 120px;
    color:#fff;
}

/* ================= ABOUT ================= */
.about-img{
    height:260px;
    object-fit:cover;
    width:100%;
}

/* ================= MISI IMAGE ================= */
.misi-image{
    width:100%;
    height:300px;
    background-image:url('{{ asset("asset/food/sau.jpg") }}');
    background-size:cover;
    background-position:center;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    transition:transform .3s ease;
}
.misi-image:hover{
    transform:scale(1.03);
}

/* ================= SECTION TITLE ================= */
.section-title{
    font-weight:700;
    margin-bottom:16px;
}

/* ================= RESPONSIVE ================= */
@media (max-width:768px){
    .misi-image{
        height:220px;
        margin-top:20px;
    }
}
</style>

{{-- ================= HERO ================= --}}
<div class="hero-tentang">
    <div class="container hero-content">
        <h1 class="hero-title">TENTANG KAMI</h1>
        <p class="mt-2 text-white-50 col-lg-6">
            Mengenal lebih dekat perjalanan dan nilai yang kami bangun bersama.
        </p>
    </div>
</div>

<div class="container my-5">

    {{-- ================= ABOUT ================= --}}
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h5 class="section-title">TASTY FOOD</h5>
            <p class="text-muted">
                Tasty Food hadir sebagai brand kuliner yang mengedepankan kualitas rasa,
                kebersihan, dan pelayanan terbaik kepada pelanggan.
            </p>
            <p class="text-muted">
                Kami percaya bahwa makanan bukan sekadar kebutuhan,
                tetapi juga pengalaman yang menyenangkan.
            </p>
        </div>
        <div class="col-lg-6">
            <div class="d-flex gap-3">
                <img src="{{ asset('asset/gambar/brooke-lark-oaz0raysASk-unsplash.jpg') }}"
                     class="img-fluid rounded-4 shadow-sm about-img">
                <img src="{{ asset('asset/gambar/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg') }}"
                     class="img-fluid rounded-4 shadow-sm about-img">
            </div>
        </div>
    </div>

    {{-- ================= VISI ================= --}}
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <div class="d-flex gap-3">
                <img src="{{ asset('asset/gambar/fathul-abrar-T-qI_MI2EMA-unsplash.jpg') }}"
                     class="img-fluid rounded-4 shadow-sm about-img">
                <img src="{{ asset('asset/gambar/michele-blackwell-rAyCBQTH7ws-unsplash.jpg') }}"
                     class="img-fluid rounded-4 shadow-sm about-img">
            </div>
        </div>
        <div class="col-lg-6">
            <h5 class="section-title">VISI</h5>
            <p class="text-muted">
                Menjadi brand kuliner terpercaya yang dikenal luas atas kualitas,
                inovasi, dan komitmen terhadap kepuasan pelanggan.
            </p>
        </div>
    </div>

    {{-- ================= MISI ================= --}}
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h5 class="section-title">MISI</h5>
            <ul class="text-muted ps-3">
                <li>Menyajikan makanan berkualitas tinggi</li>
                <li>Mengutamakan kebersihan dan keamanan pangan</li>
                <li>Memberikan pelayanan yang ramah dan profesional</li>
                <li>Terus berinovasi mengikuti selera pelanggan</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <div class="misi-image"></div>
        </div>
    </div>

    {{-- ================= VALUES ================= --}}
    {{-- <div class="row text-center">
        <div class="col-12 mb-4">
            <h5 class="section-title">NILAI KAMI</h5>
        </div>

        <div class="col-md-4 mb-4">
            <div class="p-4 shadow-sm rounded-4 h-100">
                <h6 class="fw-bold">Kualitas</h6>
                <p class="text-muted small">
                    Kami menjaga standar kualitas terbaik di setiap sajian.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="p-4 shadow-sm rounded-4 h-100">
                <h6 class="fw-bold">Kepercayaan</h6>
                <p class="text-muted small">
                    Kepercayaan pelanggan adalah prioritas utama kami.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="p-4 shadow-sm rounded-4 h-100">
                <h6 class="fw-bold">Inovasi</h6>
                <p class="text-muted small">
                    Kami terus berkembang mengikuti tren dan kebutuhan pasar.
                </p>
            </div>
        </div>
    </div> --}}

</div>

@endsection
