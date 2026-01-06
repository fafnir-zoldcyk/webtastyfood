@extends('admin.template')

@section('konten')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fa-solid fa-newspaper me-2"></i> Data Berita</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fa-solid fa-plus"></i> Tambah Berita
    </button>
</div>

<div class="row g-4">
    @forelse ($berita as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">
            @if ($item->foto)
            <img src="{{ asset('storage/foto/' . $item->foto) }}" class="card-img-top" alt="Foto Berita" style="height: 180px; object-fit: cover;">
            @else
            <div class="bg-secondary text-white d-flex justify-content-center align-items-center" style="height: 180px;">
                <span>Tidak ada gambar</span>
            </div>
            @endif

            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $item->judul }}</h5>
                <p class="card-text text-truncate" style="flex-grow: 1;">{{ Str::limit($item->isi, 100, '...') }}</p>
                
                <div class="mb-2">
                    <span class="badge bg-info me-2">
                        <i class="fa-solid fa-tag me-1"></i> {{ ucfirst($item->kategori) }}
                    </span>
                    <small class="text-muted"><i class="fa-solid fa-user me-1"></i> {{ $item->nama_penulis }}</small>
                </div>

                <div class="mt-auto d-flex justify-content-between">
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('admin-berita-update', Crypt::encrypt($item->id)) }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalEditLabel{{ $item->id }}">
                        <i class="fa-solid fa-pen"></i> Edit Berita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="judul" value="{{ $item->judul }}" placeholder="Judul" required>
                    <textarea class="form-control mb-2" name="isi" rows="4" placeholder="Isi" required>{{ $item->isi }}</textarea>
                    <input class="form-control mb-2" name="nama_penulis" value="{{ $item->nama_penulis }}" placeholder="Penulis" required>
                    <input class="form-control mb-2" type="date" name="tanggal" value="{{ $item->tanggal }}" required>

                    <select class="form-select mb-2" name="kategori" required>
                        <option value="makanan" {{ $item->kategori=='makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ $item->kategori=='minuman' ? 'selected' : '' }}>Minuman</option>
                    </select>

                    <input class="form-control" type="file" name="foto" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </button>
                    <button class="btn btn-warning" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin-berita-delete', Crypt::encrypt($item->id)) }}" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusLabel{{ $item->id }}">
                        <i class="fa-solid fa-triangle-exclamation"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Yakin hapus berita:<br>
                    <strong><i class="fa-solid fa-newspaper"></i> {{ $item->judul }}</strong> ?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </button>
                    <button class="btn btn-danger" type="submit">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            Tidak ada data berita.
        </div>
    </div>
    @endforelse
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin-berita-store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTambahLabel">
                    <i class="fa-solid fa-plus"></i> Tambah Berita
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input class="form-control mb-2" name="judul" placeholder="Judul" required>
                <textarea class="form-control mb-2" name="isi" rows="4" placeholder="Isi" required></textarea>
                <input class="form-control mb-2" name="nama_penulis" placeholder="Penulis" required>
                <input class="form-control mb-2" type="date" name="tanggal" required>

                <select class="form-select mb-2" name="kategori" required>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>

                <input class="form-control" type="file" name="foto" accept="image/*" required>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
