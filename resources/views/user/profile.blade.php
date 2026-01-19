@extends('user.nav')
@section('navbar')

<style>
.hero-page{
    height:340px;
    background:url('{{ asset("asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/Group 70.png") }}')
               center/cover no-repeat;
    position: relative;
    z-index:1;
    color:#fff;
}

.hero-page::after{
    content:'';
    position:absolute;
    inset:0;
    background: rgba(0,0,0,.55);
    z-index:1;
}

.hero-page .hero-content{
    position: relative;
    z-index:2;
    padding-top:120px;
}

/* FOTO PROFILE */
.profile-photo-wrapper{
    display:flex;
    justify-content:center;
}

.profile-photo{
    width:220px;
    height:220px;
    object-fit: cover;
    border-radius:18px;          /* KOTAK ELEGAN */
    border:6px solid #fff;
    box-shadow: 0 15px 35px rgba(0,0,0,.15);
}
</style>

<!-- HERO -->
<div class="hero-page">
    <div class="container hero-content">
        <h1 class="fw-bold">Profile Saya</h1>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        @if (session('pesan'))
            <div class="alert mt-4 alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                {{session('pesan')}}
            </div>
        @endif
        <hr>
        <!-- FOTO (CENTER) -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="profile-photo-wrapper">
                    <img src="{{ empty($user->profile)
                            ? asset('asset/food/user.png')
                            : asset('storage/profile/'.$user->profile) }}"
                         class="profile-photo">
                </div>
            </div>
        </div>

        <!-- DATA -->
        <div class="col-md-6 mb-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="mb-4">Profile Information</h5>

                <div class="mb-3">
                    <label class="text-muted">Name</label>
                    <div class="fw-semibold fs-5">{{ $user->name }}</div>
                </div>

                <div class="mb-4">
                    <label class="text-muted">Email</label>
                    <div class="fw-semibold">{{ $user->email }}</div>
                </div>

                <a href="{{ route('user.profile-edit', Crypt::encrypt($user->id)) }}"
                   class="btn btn-warning rounded-pill px-4">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    Edit Profile
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
