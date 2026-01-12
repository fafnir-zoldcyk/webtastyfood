@extends('admin.template')
@section('konten')

<style>
body { overflow-x: hidden; }

.img-thumb {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,.15);
}

.btn-icon {
    width: 34px;
    height: 34px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
</style>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">
        <i class="fa fa-circle-info text-primary"></i> Data Tentang
    </h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fa fa-plus"></i> Tambah Data
    </button>
</div>

{{-- PROFIL PERUSAHAAN --}}
@foreach($tentang ?? [] as $item)
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="fa fa-building"></i> Profil Perusahaan</span>
        <div>
            <button class="btn btn-light btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEdit{{ $item->id }}">
                <i class="fa fa-pen"></i>
            </button>

            <button class="btn btn-info btn-sm text-white"
                    data-bs-toggle="modal"
                    data-bs-target="#modalGambar{{ $item->id }}">
                <i class="fa fa-image"></i>
            </button>

            <button class="btn btn-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalHapus{{ $item->id }}">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Nama</div>
            <div class="col-md-8">{{ $item->nama }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Email</div>
            <div class="col-md-8">{{ $item->gmail }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">No Telp</div>
            <div class="col-md-8">{{ $item->no_telp }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Alamat</div>
            <div class="col-md-8">{{ $item->alamat }}</div>
        </div>

        <hr>

        <div class="mb-3">
            <h6 class="fw-bold text-primary">Deskripsi</h6>
            <p class="text-muted">{{ $item->deskripsi }}</p>
        </div>

        <div class="mb-3">
            <h6 class="fw-bold text-success">Visi</h6>
            <p class="text-muted">{{ $item->visi }}</p>
        </div>

        <div>
            <h6 class="fw-bold text-warning">Misi</h6>
            <p class="text-muted">{{ $item->misi }}</p>
        </div>
    </div>
</div>
@endforeach

{{-- DATA GAMBAR --}}
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <i class="fa fa-image"></i> Data Gambar Perusahaan
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tipe</th>
                    <th>Gambar</th>
                    <th width="80">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tentang ?? [] as $t)
                @foreach($t->gambars ?? [] as $g)
                <tr>
                    <td>{{ $g->id }}</td>
                    <td>
                        <span class="badge 
                        {{ $g->tipe == 'visi' ? 'bg-success' : ($g->tipe == 'misi' ? 'bg-warning' : 'bg-info') }}">
                            {{ strtoupper($g->tipe) }}
                        </span>
                    </td>
                    <td>
                        <img src="{{ asset('storage/tentang/'.$g->nama_file) }}" class="img-thumb">
                    </td>
                    <td>
                        <form action="{{ route('admin.gambar-delete',$g->id) }}" method="POST"
                              onsubmit="return confirm('Hapus gambar ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm btn-icon">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach($tentang ?? [] as $item)
<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.tentang-update',Crypt::encrypt($item->id)) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5>Edit Profil Perusahaan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $item->nama }}">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="gmail" class="form-control" value="{{ $item->gmail }}">
                    </div>
                    <div class="col-md-6">
                        <label>No Telp</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $item->no_telp }}">
                    </div>
                    <div class="col-md-6">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $item->alamat }}">
                    </div>
                    <div class="col-12">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="col-12">
                        <label>Visi</label>
                        <textarea name="visi" class="form-control" rows="3">{{ $item->visi }}</textarea>
                    </div>
                    <div class="col-12">
                        <label>Misi</label>
                        <textarea name="misi" class="form-control" rows="3">{{ $item->misi }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- MODAL HAPUS --}}
@foreach($tentang ?? [] as $item)
<div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <form method="POST" action="{{ route('admin.tentang-delete', Crypt::encrypt($item->id)) }}">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5>Hapus Data</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Yakin ingin menghapus</p>
                    <strong>{{ $item->nama }}</strong>?
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection
