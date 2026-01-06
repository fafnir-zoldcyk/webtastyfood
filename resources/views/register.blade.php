<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FStore</title>

    <link href="{{ asset('bootstrap1/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/fontawesome-free-6.7.2-web/css/all.min.css')}}">

    <style>
        body {
            background: linear-gradient(180deg, #2C3E50 0%, #343a40 100%) !important;
            background-attachment: fixed;
        }
        .login-container {
            max-width: 400px;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .brand-title {
            font-weight: bold;
            font-size: 2rem;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
        }
        .btn-custom-primary {
            background-color: #2C3E50 !important;
            border-color: #2C3E50 !important;
        }
        .btn-custom-primary:hover {
            background-color: #34495e !important;
            border-color: #34495e !important;
        }
        .input-group-text {
            background-color: #2C3E50;
            color: white;
        }

        /* ICON KEMBALI DI POJOK KIRI ATAS LAYAR */
        .back-icon {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            z-index: 999;
            transition: 0.2s ease-in-out;
        }
        .back-icon:hover {
            transform: translateX(-5px);
            color: #dfe6e9;
        }
    </style>
</head>
<body>

    <!-- ICON BACK DI LUAR CARD -->
    <a href="/login" class="back-icon">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <div class="brand-title">TastyFood</div>

            <form action="{{ route('regiter-store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-custom-primary text-white">Register</button>
                    <a href="/login" class="btn btn-secondary">Batal</a>
                </div>
            </form>

            <p class="text-center mt-3 text-muted">
                &copy; {{ date('Y') }} TastyFood. All rights reserved.
            </p>

        </div>
    </div>

</body>
</html>