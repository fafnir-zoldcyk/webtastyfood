@extends('admin.template')
@section('konten')
{{-- <body class="container py-4"> --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
    <h3 class="mb-3">
        <i class="fa-solid fa-newspaper me-2"></i> Data Berita
    </h3>

    <!-- Button Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fa-solid fa-plus"></i> Tambah Berita
    </button>

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Foto</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($berita as $item)
            <tr>
                <td>{{ $item->judul }}</td>
                <td>
                    <span class="badge bg-info">
                        <i class="fa-solid fa-tag"></i> {{ $item->kategori }}
                    </span>
                </td>
                <td>
                    <i class="fa-solid fa-user"></i> {{ $item->nama_penulis }}
                </td>
                <td>
                    @if($item->foto)
                        <img src="{{ asset('storage/foto/'. $item->foto) }}" alt="foto berita" style="width: 100px; height: auto;">
                        @else
                            Tidak ada gambar
                    @endif
                </td>
                <td class="text-center">
                    <!-- Edit -->
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
                </td>
            </tr>

            <!-- MODAL EDIT -->
            
            <div class="modal fade" id="modalEdit{{ $item->id}}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin-berita-update',Crypt::encrypt($item->id)) }}" enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">
                                    <i class="fa-solid fa-pen"></i> Edit Berita
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
    
                            <div class="modal-body">
                                <input class="form-control mb-2" name="judul" value="{{ $item->judul }}" placeholder="Judul">
                                <textarea class="form-control mb-2" name="isi" rows="4">{{ $item->isi }}</textarea>
                                <input class="form-control mb-2" name="nama_penulis" value="{{ $item->nama_penulis }}" placeholder="Penulis">
                                <input class="form-control mb-2" type="date" name="tanggal" value="{{ $item->tanggal }}">
    
                                <select class="form-control mb-2" name="kategori">
                                    <option value="makanan" {{ $item->kategori=='makanan'?'selected':'' }}>Makanan</option>
                                    <option value="minuman" {{ $item->kategori=='minuman'?'selected':'' }}>Minuman</option>
                                </select>
    
                                <input class="form-control" type="file" name="foto">
                            </div>
    
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-xmark"></i> Batal
                                </button>
                                <button class="btn btn-warning">
                                    <i class="fa-solid fa-floppy-disk"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL HAPUS -->
            <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form method="POST" action="{{ route('admin-berita-delete',Crypt::encrypt($item->id)) }}" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">
                                    <i class="fa-solid fa-triangle-exclamation"></i> Konfirmasi Hapus
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
    
                            <div class="modal-body">
                                Yakin hapus berita:
                                <br>
                                <item><i class="fa-solid fa-newspaper"></i> {{ $item->judul }}</item> ?
                            </div>
    
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-xmark"></i> Batal
                                </button>
                                <button class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('admin-berita-store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-plus"></i> Tambah Berita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="judul" placeholder="Judul">
                    <textarea class="form-control mb-2" name="isi" rows="4" placeholder="Isi"></textarea>
                    <input class="form-control mb-2" name="nama_penulis" placeholder="Penulis">
                    <input class="form-control mb-2" type="date" name="tanggal">

                    <select class="form-control mb-2" name="kategori">
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                    </select>

                    <input class="form-control" type="file" name="foto">
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
{{-- </body> --}}
@endsection
