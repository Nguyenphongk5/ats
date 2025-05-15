<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quên mật khẩu - JobFinder</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(to right, #bfdbfe, #ffffff);">
        <div class="card shadow-sm p-4" style="max-width: 420px; width: 100%; border-radius: 0.75rem;">
            <div class="mb-4 text-secondary">
                Quên mật khẩu? Không vấn đề gì. Vui lòng nhập email của bạn, chúng tôi sẽ gửi liên kết đặt lại mật khẩu.
            </div>

            <!-- Hiển thị thông báo trạng thái session -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-dark">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        Gửi liên kết đặt lại mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
