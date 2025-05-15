<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng ký</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(to right, #bfdbfe, #ffffff);">
        <div class="card shadow-sm p-4" style="max-width: 420px; width: 100%; border-radius: 0.75rem;">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary">CMC CORP</h1>
                <p class="text-secondary">Tạo tài khoản để tiếp cận cơ hội nghề nghiệp tốt nhất</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold text-dark">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" required autofocus autocomplete="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-dark">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" required autocomplete="username"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold text-dark">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="form-control @error('password') is-invalid @enderror" />
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold text-dark">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="form-control @error('password_confirmation') is-invalid @enderror" />
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit" class="btn btn-primary fw-semibold">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
