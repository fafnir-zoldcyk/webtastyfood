@extends('admin.template')
@section('konten')
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
    <h3 class="mb-3">
        <i class="fa-solid fa-newspaper"></i> Data Tentang Kami
    </h3>

    <!-- Button Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fa-solid fa-plus"></i> Tambah Tentang Kami
    </button>

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Visi</th>
                <th>Misi</th>
                <th>Gmail</th>
                <th>No Telp</th>
                <th>Alamat</th>
                {{-- <th>Gambar</th> --}}
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tentang as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->visi }}</td>
                <td>{{ $item->misi }}</td>
                <td>{{ $item->gmail }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->alamat }}</td>
                {{-- <td>
                    @if($item->foto)
                        <img src="{{ asset('storage/pic/'. $item->foto) }}" alt="foto berita" style="width: 100px; height: auto;">
                        @else
                            Tidak ada gambar
                    @endif
                </td> --}}
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
                        <form method="POST" action="{{ route('admin.tentang-update',Crypt::encrypt($item->id)) }}" enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">
                                    <i class="fa-solid fa-pen"></i> Edit Tentang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
    
                            <div class="modal-body">
                                <input type="text" class="form-control mb-2" name="nama" value="{{ $item->nama }}" placeholder="Nama">
                                <textarea class="form-control mb-2" name="deskripsi" rows="4">{{ $item->deskripsi }}</textarea>
                                <input type="text" class="form-control mb-2" name="visi" value="{{ $item->visi }}" placeholder="Visi">
                                <input type="text" class="form-control mb-2" name="misi" value="{{ $item->misi }}" placeholder="Misi">
                                <input type="text" class="form-control mb-2" name="gmail" value="{{ $item->gmail }}" placeholder="Gmail">
                                <input type="number" class="form-control mb-2" name="no_telp" value="{{ $item->no_telp }}" placeholder="No Telp">
                                <input type="text" class="form-control mb-2" name="alamat" value="{{ $item->alamat }}" placeholder="Alamat">
    
                                {{-- <input class="form-control" type="file" name="gambar"> --}}
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

                        <form method="POST" action="{{ route('admin.tentang-delete',Crypt::encrypt($item->id)) }}" class="modal-content">
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
                                <item><i class="fa-solid fa-newspaper"></i> {{ $item->nama }}</item> ?
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
            <form method="POST" action="{{ route('admin.tentang-store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-plus"></i> Tambah Tentang
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control mb-2" name="nama" placeholder="Nama">
                        <label for="">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control mb-2" name="deskripsi" rows="4" placeholder="Deskripsi"></textarea>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control mb-2" name="visi" placeholder="Visi">
                        <label for="">Visi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control mb-2" name="misi" placeholder="Misi">
                        <label for="">Misi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control mb-2" name="gmail" placeholder="Gmail">
                        <label for="">Gmail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control mb-2" name="no_telp" placeholder="No Telp">
                        <label for="">No Telp</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control mb-2" name="alamat" placeholder="Alamat">
                        <label for="">Alamat</label>
                    </div>
                    {{-- <div class="form-floating mb-3">
                        <input class="form-control" type="file" name="gambar">
                        <label for="">Gambar</label>
                    </div> --}}

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
