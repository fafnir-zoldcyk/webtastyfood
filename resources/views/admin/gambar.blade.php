@extends('admin.template')
@section('konten')
    {{-- pemberuutahuan jika berhasil --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
    <h3 class="mb-3">
        <i class="fas fa-image"></i>Data Gambar Tentang Kami
    </h3>

    <!-- Button Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahGambar">
        <i class="fas fa-plus"></i> Tambah Gambar
    </button>
    <div class="row g-4">
        @foreach ($gambar as $item)
            <div class="col-md-4">
                <div class="card shadow-sm rounded-4 h-100">
                    {{-- @if ($item->tipe == 'foto') --}}
                    <img src="{{ asset('storage/gambar/' .$item->gambar) }}"
                    class="card-img-top rounded-top-4" alt="{{ $item->gambar }}">
                    {{-- @elseif ($item->tipe == 'video')
                    <video width="100%" height="auto" controls>
                        <source src="{{ asset('storage/gambar/' .$item->gambar) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                    </video> --}}
                    {{-- @endif --}}


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
                        {{ \Carbon\Carbon::parse($item->timestamp)->format('d M Y') }}
                    </div>
                </div>
            </div>
            {{-- modal edit --}}
            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel{{ $item->id }}">Edit Gambar Tentang Kami</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.gambar-update', Crypt::encrypt($item->id)) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Tipe Gambar</label>
                                    <select class="form-control" id="tipe" name="tipe" required>
                                        <option value="perusahaan" {{ $item->tipe == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                        <option value="visi" {{ $item->tipe == 'visi' ? 'selected' : '' }}>Visi</option>
                                        <option value="misi" {{ $item->tipe == 'misi' ? 'selected' : '' }}>Misi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- modal hapus --}}
            <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusLabel{{ $item->id }}">Hapus Gambar Tentang Kami</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus gambar ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('admin.gambar-delete', Crypt::encrypt($item->id)) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Modal Tambah Gambar --}}
    <div class="modal fade" id="tambahGambar" tabindex="-1" aria-labelledby="tambahGambarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGambarLabel">Tambah Gambar Tentang Kami</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.gambar-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe Gambar</label>
                            <select class="form-control" id="tipe" name="tipe" required>
                                <option value="">Pilih Tipe</option>
                                <option value="perusahaan">Perusahaan</option>
                                <option value="visi">Visi</option>
                                <option value="misi">Misi</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Gambar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection