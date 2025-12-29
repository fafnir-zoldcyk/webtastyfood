@extends('admin.template')
@section('konten')
    {{-- pemberitahuan jika berhasil --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- pemberitahun jika error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>  
                @endforeach
            </ul>
        </div>
    @endif
    <h3 class="mb-3">
        <i class="fas fa-images me-2"></i>Data Gallery
    </h3>
    <!-- Button Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahGallery">
        <i class="fas fa-plus"></i> Tambah Gambar Gallery
    </button>
    <div class="row g-4">
        @foreach ($gallery as $item)
            <div class="col-md-4">
                <div class="card shadow-sm rounded-4 h-100">
                    @if ($item->tipe == 'foto')
                    <img src="{{ asset('storage/galeri/' .$item->gambar) }}"
                    class="card-img-top rounded-top-4" alt="{{ $item->gambar }}">
                    @elseif ($item->tipe == 'video')
                    <video width="100%" height="auto" controls>
                        <source src="{{ asset('storage/galeri/' .$item->gambar) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                    </video>
                    @endif

                    <div class="card-body">
                        <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEdit{{ $item->id }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <!-- Hapus -->
                    <button class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalHapus{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    </div>
                    <div class="card-footer text-muted-small">
                        {{ Carbon::parse($item->timestamp)->format('d m Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- modal tambah gallery --}}
    <div class="modal fade" id="tambahGallery" tabindex="-1" aria-labelledby="tambahGalleryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gambar Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.gallery-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Pilih Gambar/Video</label>
                            <input class="form-control" type="file" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <select class="form-select" id="tipe" name="tipe" required>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection