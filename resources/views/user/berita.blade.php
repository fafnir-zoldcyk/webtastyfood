@extends('user.nav')
@section('navbar')

<style>
/* HERO */
.hero-berita {
    position: relative;
    background: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
        url('{{ asset("storage/foto/".$berita->foto) }}') center/cover no-repeat;
    height: 360px;
    color: #fff;
}

/* CARD BERITA */
.card-berita {
    border: 0;
    border-radius: 16px;
    overflow: hidden;
    transition: .3s;
}
.card-berita:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,.12);
}
.card-berita img {
    height: 180px;
    object-fit: cover;
}
.card-berita a {
    color: #f59e0b;
    font-weight: 500;
    text-decoration: none;
}

/* ISI BERITA */
.berita-content p {
    line-height: 1.8;
    font-size: 1.05rem;
}
</style>

{{-- ================= HERO ================= --}}
<section class="hero-berita d-flex align-items-center">
    <div class="container">
        <h1 class="fw-bold display-6">BERITA KAMI</h1>
    </div>
</section>

{{-- ================= BERITA UTAMA ================= --}}
<section class="container my-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <img src="{{ asset('storage/foto/'.$berita->foto) }}"
                 class="img-fluid rounded-4 shadow w-100"
                 style="max-height:380px; object-fit:cover;">
        </div>

        <div class="col-lg-6">
            <span class="badge bg-warning text-dark mb-2">
                {{ ucfirst($berita->kategori) }}
            </span>

            <h3 class="fw-bold mb-3">
                {{ $berita->judul }}
            </h3>

            <p class="text-muted">
                {{ Str::limit(strip_tags($berita->isi), 220) }}
            </p>

            <a href="#detail" class="btn btn-dark px-4">
                BACA SELENGKAPNYA
            </a>
        </div>
    </div>
</section>

{{-- ================= BERITA LAINNYA ================= --}}
<section class="container my-5">
    <h4 class="fw-bold mb-4">BERITA LAINNYA</h4>

    <div class="row g-4">
        @foreach($lainnya as $item)
        <div class="col-md-6 col-lg-3">
            <div class="card card-berita h-100 shadow-sm">
                <img src="{{ asset('storage/foto/'.$item->foto) }}">

                <div class="card-body">
                    <h6 class="fw-bold">{{ $item->judul }}</h6>
                    <p class="text-muted small">
                        {{ Str::limit(strip_tags($item->isi), 80) }}
                    </p>

                    <a href="{{ route('user.detail', Crypt::encrypt($item->id)) }}">
                        Baca selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ================= DETAIL + KOMENTAR (ASLI, TIDAK DIHAPUS) ================= --}}
<section class="container my-5" id="detail">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <img src="{{ asset('storage/foto/'.$berita->foto) }}"
                 class="img-fluid rounded-4 shadow mb-4 w-100"
                 style="max-height:420px; object-fit:cover;">

            <div class="berita-content">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            <hr class="my-5">

            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="fw-bold mb-0">{{ $berita->author }}</p>
                    <small class="text-muted">Penulis</small>
                </div>
                <i class="fa-regular fa-comment fa-lg"></i>
            </div>

            <hr class="my-5">

            <h4 class="fw-bold mb-4">
                <i class="fa-regular fa-comment text-warning me-2"></i>
                Komentar ({{ $komentar->count() ?? 0 }})
            </h4>

            @auth
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Tulis Komentar</h5>

                    <form action="{{ route('komentar.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="berita_id" value="{{ $berita->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="">Pilih Rating</option>
                                <option value="5">★★★★★ Sangat Baik</option>
                                <option value="4">★★★★ Baik</option>
                                <option value="3">★★★ Cukup</option>
                                <option value="2">★★ Kurang</option>
                                <option value="1">★ Buruk</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Komentar</label>
                            <textarea name="komentar" rows="4" class="form-control" required></textarea>
                        </div>

                        <button class="btn btn-warning text-dark px-4">
                            Kirim Komentar
                        </button>
                    </form>

                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <i class="fa-solid fa-lock me-1"></i>
                Silakan <a href="{{ route('admin.login') }}">login</a> untuk memberi komentar.
            </div>
            @endauth

            @foreach($komentar as $k)
            <div class="mb-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $k->nama }}</h6>
                        <small class="text-muted">{{ $k->email }}</small>
                    </div>
                    <div class="text-warning">
                        @for($i=1; $i<=5; $i++)
                            <i class="fa-star {{ $i <= $k->rating ? 'fa-solid' : 'fa-regular' }}"></i>
                        @endfor
                    </div>
                </div>

                <p class="mt-2 text-muted">
                    {{ $k->komentar }}
                </p>

                <small class="text-muted">
                    {{ $k->created_at->diffForHumans() }}
                </small>
            </div>
            <hr>
            @endforeach

        </div>
    </div>
</section>

@endsection
