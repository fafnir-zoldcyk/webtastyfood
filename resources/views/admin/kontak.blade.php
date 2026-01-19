@extends('admin.template')
@section('konten')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Inbox Kontak</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKontak">
            <i class="fas fa-plus"></i> Tambah Kontak
        </button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($kontak->count())
        <div class="row">
            @foreach($kontak as $item)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->nama }}</strong><br>
                                <small class="text-muted">{{ $item->email }}</small>
                            </div>
                            <span class="badge bg-secondary">
                                {{ $item->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <div class="card-body">
                            <h6 class="fw-bold">
                                {{ $item->subject ?? 'Tanpa Subjek' }}
                            </h6>

                            <p class="text-muted mb-2">
                                {{ \Illuminate\Support\Str::limit($item->pesan, 100) }}
                            </p>

                            <button class="btn btn-sm btn-outline-primary"
                                data-bs-toggle="collapse"
                                data-bs-target="#detailPesan{{ $item->id }}">
                                Lihat Pesan
                            </button>

                            <div class="collapse mt-3" id="detailPesan{{ $item->id }}">
                                <div class="border rounded p-2 bg-light">
                                    {{ $item->pesan }}
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editKontak{{ $item->id }}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusKontak{{ $item->id }}">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>

                {{-- MODAL EDIT --}}
                <div class="modal fade" id="editKontak{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.kontak-update', Crypt::encrypt($item->id)) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kontak</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $item->nama }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $item->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $item->subject }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Pesan</label>
                                        <textarea name="pesan" class="form-control" rows="4">{{ $item->pesan }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- MODAL HAPUS --}}
                <div class="modal fade" id="hapusKontak{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Hapus Kontak</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Yakin hapus pesan dari <strong>{{ $item->nama }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('admin.kontak-delete', Crypt::encrypt($item->id)) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @else
        <div class="alert alert-info">Belum ada pesan masuk.</div>
    @endif
</div>

@endsection
 
{{-- MODAL TAMBAH --}}