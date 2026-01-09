@extends('admin.template')
@section('konten')
    <style>
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
    .text-limit {
        max-width: 220px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

{{-- pemberitahuan jika berhasil --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- pemberitahuan jika ada yang error --}}
    @if ($errors->any())
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

{{-- ================= TABEL TENTANG ================= --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        Profil Perusahaan
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-center">
                <tr>
                    <th>Nama</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tentang as $item)
                <tr>
                    <td>{{ $item->nama }}</td>

                    <td>
                        <span class="text-limit" title="{{ $item->visi }}">
                            {{ $item->visi }}
                        </span>
                    </td>

                    <td>
                        <span class="text-limit" title="{{ $item->misi }}">
                            {{ $item->misi }}
                        </span>
                    </td>

                    <td>{{ $item->gmail }}</td>
                    <td>{{ $item->no_telp }}</td>

                    <td class="text-center">
                        <button class="btn btn-warning btn-sm btn-icon"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEdit{{ $item->id }}">
                            <i class="fa fa-pen"></i>
                        </button>

                        <button class="btn btn-info btn-sm btn-icon"
                                data-bs-toggle="modal"
                                data-bs-target="#modalGambar{{ $item->id }}">
                            <i class="fa fa-image"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ================= TABEL GAMBAR ================= --}}
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Data Gambar Perusahaan
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover align-middle mb-0 text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tipe</th>
                    <th>Gambar</th>
                    <th width="80">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tentang as $t)
                @foreach($t->gambartentangs as $g)
                <tr>
                    <td>{{ $g->id }}</td>
                    <td>
                        <span class="badge bg-info">
                            {{ strtoupper($g->tipe) }}
                        </span>
                    </td>
                    <td>
                        <img src="{{ asset('storage/tentang/'.$g->nama_file) }}"
                             class="img-thumb">
                    </td>
                    <td>
                        <form action="{{ route('admin.gambar-delete',$g->id) }}"
                              method="POST"
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

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.tentang-store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5>Tambah Tentang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="gmail" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>No Telp</label>
                        <input type="text" name="no_telp" class="form-control">
                    </div>
                    <div class="col-12">
                        <label>Visi</label>
                        <textarea name="visi" class="form-control"></textarea>
                    </div>
                    <div class="col-12">
                        <label>Misi</label>
                        <textarea name="misi" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
@foreach($tentang as $item)
<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.tentang-update',$item->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5>Edit Tentang</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control"
                               value="{{ $item->nama }}">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="gmail" class="form-control"
                               value="{{ $item->gmail }}">
                    </div>
                    <div class="col-md-6">
                        <label>No Telp</label>
                        <input type="text" name="no_telp" class="form-control"
                               value="{{ $item->no_telp }}">
                    </div>
                    <div class="col-12">
                        <label>Visi</label>
                        <textarea name="visi" class="form-control">{{ $item->visi }}</textarea>
                    </div>
                    <div class="col-12">
                        <label>Misi</label>
                        <textarea name="misi" class="form-control">{{ $item->misi }}</textarea>
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

{{-- ================= MODAL TAMBAH GAMBAR ================= --}}
@foreach($tentang as $t)
<div class="modal fade" id="modalGambar{{ $t->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
              action="{{ route('admin.gambar-store',$t->id) }}"
              enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5>Tambah Gambar</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="file" name="nama_file" class="form-control mb-2" required>

                    <select name="tipe" class="form-control" required>
                        <option value="perusahaan">Perusahaan</option>
                        <option value="visi">Visi</option>
                        <option value="misi">Misi</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-info text-white">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
