<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(to right, #bfdbfe, #ffffff);">
        <div class="card shadow-sm p-4" style="max-width: 420px; width: 100%; border-radius: 0.75rem;">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary">CMC CORP</h1>
                <p class="text-secondary">Đăng nhập để tiếp cận cơ hội nghề nghiệp tốt nhất</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-dark">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold text-dark">Mật khẩu</label>
                    <input id="password" type="password" name="password" required
                        class="form-control @error('password') is-invalid @enderror" />
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me và Quên mật khẩu -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input" />
                        <label for="remember" class="form-check-label text-dark">Ghi nhớ đăng nhập</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 fw-semibold py-2">
                    Đăng nhập
                </button>
            </form>

            <p class="mt-4 text-center text-secondary">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Đăng ký ngay</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS (tùy chọn) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
