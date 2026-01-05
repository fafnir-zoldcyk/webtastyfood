@extends('user.template')

@section('content')

<style>
    .hero-berita {
        background: linear-gradient(
            rgba(0,0,0,.55),
            rgba(0,0,0,.55)
        ),
        url('{{ asset("storage/foto/".$berita->foto) }}') center/cover no-repeat;
        height: 320px;
        color: #fff;
    }

    .berita-content p {
        line-height: 1.8;
        font-size: 1.05rem;
    }
</style>

{{-- HERO --}}
<section class="hero-berita d-flex align-items-center">
    <div class="container">
        <span class="badge bg-warning text-dark mb-3">
            {{ ucfirst($berita->kategori) }}
        </span>

        <h1 class="fw-bold">
            {{ $berita->judul }}
        </h1>

        <p class="mb-0 opacity-75">
            {{ $berita->author }} ·
            {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
        </p>
    </div>
</section>

{{-- CONTENT --}}
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            {{-- GAMBAR UTAMA --}}
            <img src="{{ asset('storage/foto/'.$berita->foto) }}"
                 class="img-fluid rounded-4 shadow mb-4 w-100"
                 style="max-height:420px; object-fit:cover;">

            {{-- ISI --}}
            <div class="berita-content">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            {{-- AUTHOR --}}
            <hr class="my-5">

            <div class="d-flex align-items-center justify-content-between">
                <div class="ms-3">
                    <p class="fw-bold mb-0">{{ $berita->author }}</p>
                    <small class="text-muted">Penulis</small>
                </div>
                <i class="fa-regular fa-comment fa-lg">comment</i>
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

                        {{-- RATING --}}
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

                        {{-- KOMENTAR --}}
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

            <div class="comment-list">
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
    </div>
</section>

@endsection