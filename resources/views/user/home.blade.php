@extends('user.template')

@section('title','Home - Tasty Food','body-class')

@section('content')
<section class="home-hero">
    <div class="container">
        <div class="row align-items-center">

            {{-- TEXT KIRI --}}
            <div class="col-md-6 hero-text">
                <h1>
                    <span class="line-top">HEALTHY</span><br>
                </h1>
                <h1 class="hero-title">
                    TASTY FOOD
                </h1>

                <p class="mt-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Phasellus ornare augue eu rutrum commodo.
                </p>

                <a href="/tentang" class="btn btn-tentang ">
                    TENTANG KAMI
                </a>
            </div>

            {{-- GAMBAR POJOK KANAN --}}
                <img src="{{ asset('asset/gambar/img-4-2000x2000.png') }}"
                     class="img-fluid hero-img">
        </div>
    </div>
</section>
{{-- TENTANG KAMI --}}
<section class="about-home">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                
                    <h2 class="section-title">TENTANG KAMI</h2>

                <p class="section-text mt-4">
                    Tasty Food adalah restoran yang menyajikan makanan sehat
                    dengan cita rasa terbaik. Kami berkomitmen menggunakan
                    bahan berkualitas, proses higienis, dan pelayanan terbaik
                    untuk kepuasan pelanggan.
                </p>

                <div class="divider-line"></div>
            </div>
        </div>
    </div>
</section>

 {{-- Daftar menu --}}
    <section class="food-section">
    <div class="container">
        <div class="row g-4 justify-content-center">

            {{-- Card 1 --}}
            <div class="col-lg-3 col-md-6">
                <div class="food-card">
                    <img src="{{ asset('asset/gambar/img-1.png') }}" alt="">
                    <h5>LOREM IPSUM</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Phasellus ornare, augue eu rutrum commodo.
                    </p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="col-lg-3 col-md-6">
                <div class="food-card">
                    <img src="{{ asset('asset/gambar/img-2.png') }}" alt="">
                    <h5>LOREM IPSUM</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Phasellus ornare, augue eu rutrum commodo.
                    </p>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="col-lg-3 col-md-6">
                <div class="food-card">
                    <img src="{{ asset('asset/gambar/michele-blackwell-rAyCBQTH7ws-unsplash.jpg') }}" alt="">
                    <h5>LOREM IPSUM</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Phasellus ornare, augue eu rutrum commodo.
                    </p>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="col-lg-3 col-md-6">
                <div class="food-card">
                    <img src="{{ asset('asset/gambar/img-4.png') }}" alt="">
                    <h5>LOREM IPSUM</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Phasellus ornare, augue eu rutrum commodo.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- berita --}}
<div class="container my-5">

    <h3 class="text-center fw-bold mb-4">BERITA KAMI</h3>

    <div class="row g-4">

        {{-- BERITA UTAMA --}}
        <div class="col-lg-6">
            <div class="card shadow-sm rounded-4 card-utama">
                <img src="{{  asset('storage/foto/'. $utama->foto) }}" class="card-img-top rounded-top-4">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $utama->judul }}</h5>
                    <p class="text-muted">{{ $utama->deskripsi }}</p>
                    <a href="{{ route('user.detail', Crypt::encrypt($utama->id)) }}" class="read-more">Baca selengkapnya</a>
                </div>
            </div>
        </div>

        {{-- BERITA KECIL --}}
        <div class="col-lg-6">
            <div class="row g-4">
                @foreach($berita as $item)
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <img src="{{  asset('storage/foto/'. $item->foto) }}" class="card-img-top rounded-top-4">
                        <div class="card-body d-flex flex-column">
                            <h6 class="fw-bold">{{ $item['judul'] }}</h6>
                            <p class="text-muted small flex-grow-1">
                                {{ $item['deskripsi'] }}
                            </p>
                            <a href="{{ route('user.detail', Crypt::encrypt($item->id)) }}" class="read-more small">Baca selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- galeri --}}
        <div class="container my-5">

            <h3 class="text-center fw-bold mb-5">GALERI KAMI</h3>

            <div class="row g-4">
                @foreach($galeri as $img)
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('storage/gallery/'.$img->nama) }}" class="galeri-img">
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="/galeri" class="btn btn-galeri">LIHAT LEBIH BANYAK</a>
            </div>
        </div>
    </div>

</div>
@endsection