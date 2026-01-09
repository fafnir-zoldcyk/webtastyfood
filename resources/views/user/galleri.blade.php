@extends('user.nav')

@section('navbar')
<style>
/* =======================
   BANNER
======================= */
.banner {
    background: url('{{ asset("asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/Group 70.png") }}')
        center center / cover no-repeat;
    height: 260px;
    position: relative;
    color: #fff;
}

.banner::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
}

.banner-content {
    position: relative;
    z-index: 2;
}

/* =======================
   CONTENT
======================= */
.content {
    padding: 60px 80px;
    background: #f7f7f7;
}

/* =======================
   CAROUSEL
======================= */
.featured-slider {
    background: #fff;
    border-radius: 18px;
    padding: 20px;
    margin-bottom: 60px;
}

.carousel-inner img {
    height: 420px;
    object-fit: cover;
    border-radius: 14px;
}

/* =======================
   GALLERY
======================= */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

.gallery-grid img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 14px;
    transition: transform 0.3s ease;
}

.gallery-grid img:hover {
    transform: scale(1.05);
}

/* =======================
   RESPONSIVE
======================= */
@media (max-width: 768px) {
    .content {
        padding: 40px 20px;
    }

    .carousel-inner img {
        height: 260px;
    }
}
</style>

<!-- =======================
     BANNER
======================= -->
<div class="banner d-flex align-items-center">
    <div class="container banner-content">
        <h1 class="fw-bold">GALERI KAMI</h1>
    </div>
</div>

<!-- =======================
     CONTENT
======================= -->
<div class="content">

    <!-- CAROUSEL -->
    <section class="featured-slider">
        <div id="foodCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">
                @foreach ($galeri as $item)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('storage/galeri/'.$item->nama) }}" class="d-block w-100" alt="...">
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button"
                data-bs-target="#foodCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button"
                data-bs-target="#foodCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    </section>

    <!-- GALLERY GRID -->
    <section class="gallery">
        <div class="gallery-grid">
            @foreach ($galeri as $image)
            <img src="{{ asset('storage/galeri/'.$image->nama) }}" alt="Gallery Image">
            @endforeach
        </div>
    </section>

</div>
@endsection