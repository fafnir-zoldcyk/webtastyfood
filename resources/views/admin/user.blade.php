@extends('admin.template')

@section('konten')
<div class="container-fluid">

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                    
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users me-2 text-primary"></i> Data User
            </h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus me-1"></i> Tambah User
            </button>
        </div>

        <div class="card-body">

            {{-- Search --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm" placeholder="Cari user...">
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    <span class="badge {{ $item->role == 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $item->id }}">
                                                    <i class="fas fa-pen me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalHapus{{ $item->id }}">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- MODAL EDIT & HAPUS (LOOP TERPISAH) --}}
            @foreach ($user as $item)

                {{-- Modal Edit --}}
                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form class="modal-content"
                              action="{{ route('admin.user-update', Crypt::encrypt($item->id)) }}"
                              method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ $item->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control"
                                               value="{{ $item->username }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Password (Opsional)</label>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Kosongkan jika tidak diubah">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                        <select name="role" class="form-select">
                                            <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ $item->role == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Modal Hapus --}}
                <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <form class="modal-content"
                              action="{{ route('admin.user-delete',Crypt::encrypt($item->id)) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">
                                    <i class="fas fa-triangle-exclamation me-2"></i>
                                    Konfirmasi Hapus
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body text-center">
                                <p class="mb-1">Yakin ingin menghapus user:</p>
                                <h6 class="fw-bold">{{ $item->name }}</h6>
                                <small class="text-muted">Data tidak dapat dikembalikan.</small>
                            </div>

                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('admin.user-store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
