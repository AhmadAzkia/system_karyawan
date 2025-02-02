<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-lg p-4" style="width: 350px;">
            <h3 class="text-center mb-4">Sistem Karyawan</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="username">Nama Karyawan</label>
                    <input type="text" name="username" id="username" required>
                </div>

                <div>
                    <label for="password">Tanggal Lahir (Password)</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <button type="submit">Login</button>

                @if ($errors->has('error'))
                    <p>{{ $errors->first('error') }}</p>
                @endif
            </form>

            <div class="mt-3">
                <!-- Tombol untuk masuk ke halaman login admin -->
                <a href="{{ route('admin.login') }}" class="btn btn-secondary">Masuk ke Admin Login</a>
            </div>
            <div class="text-center mt-3">
                <small class="text-muted">&copy; {{ date('Y') }} Sistem Karyawan</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
