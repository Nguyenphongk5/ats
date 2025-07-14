<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng nhập - CMC CORP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #ffffff 50%, #f0f9ff 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(56, 189, 248, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .login-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.5);
            max-width: 440px;
            width: 100%;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow:
                0 35px 70px -12px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.6);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.4), transparent);
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .brand-subtitle {
            color: #64748b;
            text-align: center;
            font-size: 1rem;
            font-weight: 400;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating input {
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 16px;
            padding: 1.5rem 1.25rem 0.75rem;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-floating input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.1);
            background: rgba(255, 255, 255, 0.95);
            outline: none;
        }

        .form-floating label {
            color: #64748b;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 1rem 1.25rem;
            transition: all 0.3s ease;
        }

        .form-floating input:focus ~ label,
        .form-floating input:not(:placeholder-shown) ~ label {
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
            color: #3b82f6;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.75rem;
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .form-check-label {
            color: #475569;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .forgot-password {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 8px;
            border-left: 3px solid #dc2626;
        }

        @media (max-width: 768px) {
            .login-card {
                padding: 2rem;
                margin: 1rem;
            }

            .brand-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-4">
                <h1 class="brand-title">CMC CORP</h1>
                <p class="brand-subtitle">Hê thống theo dõi đánh giá tuyển dụng</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-floating">
                    <input type="email" id="email" name="email" required autofocus
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email của bạn" />
                    <label for="email">Email</label>
                    @error('email')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-floating">
                    <input type="password" id="password" name="password" required
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Mật khẩu" />
                    <label for="password">Mật khẩu</label>
                    @error('password')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me và Quên mật khẩu -->
                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input" />
                        <label for="remember" class="form-check-label">Ghi nhớ đăng nhập</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="login-btn">
                    Đăng nhập
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
