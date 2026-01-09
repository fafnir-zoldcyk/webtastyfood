@extends('admin.template')
@section('konten')
<style>
  /* STAT CARD */
.stat-card {
    display: flex;
    align-items: center;
    padding: 24px;
    border-radius: 16px;
    color: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,.15);
    transition: 0.3s;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-card .icon {
    font-size: 36px;
    margin-right: 20px;
    opacity: .9;
}

.stat-card .info span {
    font-size: 14px;
    opacity: .9;
}

.stat-card .info h3 {
    margin: 0;
    font-weight: 700;
}

/* MODERN CARD */
.modern-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

/* TIMELINE */
.timeline {
    list-style: none;
    padding-left: 0;
    position: relative;
}

.timeline li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 20px;
}

.timeline .dot {
    position: absolute;
    left: 0;
    top: 6px;
    width: 10px;
    height: 10px;
    background: #22c55e;
    border-radius: 50%;
}

.timeline li:not(:last-child)::before {
    content: '';
    position: absolute;
    left: 4px;
    top: 18px;
    width: 2px;
    height: 100%;
    background: #e5e7eb;
}

</style>
<h3 class="mb-4 fw-bold">
    <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
</h3>

{{-- ================= STAT CARD ================= --}}
<div class="row g-4 mb-4">

    {{-- BERITA --}}
    <div class="col-md-4">
        <div class="stat-card bg-primary">
            <div class="icon">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div class="info">
                <span>Total Berita</span>
                <h3>{{ $totalBerita ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- GALERI --}}
    <div class="col-md-4">
        <div class="stat-card bg-success">
            <div class="icon">
                <i class="fa-solid fa-images"></i>
            </div>
            <div class="info">
                <span>Total Galeri</span>
                <h3>{{ $totalGaleri ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- KONTAK --}}
    <div class="col-md-4">
        <div class="stat-card bg-warning">
            <div class="icon">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="info">
                <span>Pesan Masuk</span>
                <h3>{{ $totalKontak ?? 0 }}</h3>
            </div>
        </div>
    </div>

</div>

{{-- ================= CONTENT ================= --}}
<div class="row g-4">

    {{-- SELAMAT DATANG --}}
    <div class="col-lg-7">
        <div class="card modern-card h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    👋 Selamat Datang
                </h5>

                <p class="text-muted">
                    Selamat datang di <strong>Dashboard Admin Tasty Food</strong>.
                    Dari sini kamu bisa mengelola seluruh konten website dengan mudah.
                </p>

                <div class="row mt-3">
                    <div class="col-6 mb-2">✔ Data Berita</div>
                    <div class="col-6 mb-2">✔ Galeri Website</div>
                    <div class="col-6 mb-2">✔ Tentang Kami</div>
                    <div class="col-6 mb-2">✔ Pesan Kontak</div>
                </div>
            </div>
        </div>
    </div>

    {{-- AKTIVITAS --}}
    <div class="col-lg-5">
        <div class="card modern-card h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    ⏱ Aktivitas Terbaru
                </h5>

                <ul class="timeline">
                    @forelse($beritaTerbaru ?? [] as $b)
                    <li>
                        <span class="dot"></span>
                        <div class="content">
                            <strong>{{ $b->judul }}</strong>
                            <small class="text-muted d-block">
                                {{ \Carbon\Carbon::parse($b->created_at)->diffForHumans() }}
                            </small>
                        </div>
                    </li>
                    @empty
                    <li class="text-muted fst-italic">
                        Belum ada aktivitas
                    </li>
                    @endforelse
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection
