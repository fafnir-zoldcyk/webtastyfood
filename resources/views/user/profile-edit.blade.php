@extends('user.nav')
@section('navbar')
<div class="container mt-3">
        <h4>Edit Profile</h4>
        <hr>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Validate Invalid</strong>
                <ul>
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('user.profile-update', Crypt::encrypt($user->id)) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="image">
                            @if ($user->profile == NULL || $user->profile == '-')
                                <img src="{{ asset('asset/food/user.png')}}" width="450" height="450" alt="">
                            @else
                                <img src="{{ asset('storage/profile/'.$user->profile)}}" class="rounded-5" width="450" height="450" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}">
                    </div>
                    <div class="mt-3">
                        <label for="profile" class="form-label">Upload Image</label><br>
                        <input type="file" name="profile" id="profile" class="form-control">
                    </div>
                    <div class="mt-4">
                        <input type="submit" class="btn btn-dark w-100" value="Save">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection