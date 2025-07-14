@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.15)"/><circle cx="10" cy="90" r="0.5" fill="rgba(255,255,255,0.15)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.15)"/></svg>');
        background-size: 200px 200px;
        pointer-events: none;
        z-index: -1;
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .main-container {
        position: relative;
        z-index: 1;
        padding: 2rem 1rem;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-wrapper {
        width: 100%;
        max-width: 500px;
        position: relative;
    }

    .contact-form {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.18);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .contact-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
        background-size: 300% 100%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .contact-form:hover {
        transform: translateY(-5px);
        box-shadow:
            0 30px 60px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.3);
    }

    .page-title {
        text-align: center;
        margin-bottom: 2rem;
        color: #fff;
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .page-title i {
        background: linear-gradient(45deg, #f093fb, #f5576c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.2rem;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-control {
        background: rgba(248, 249, 250, 0.8);
        border: 2px solid rgba(108, 117, 125, 0.1);
        border-radius: 16px;
        padding: 1.2rem 1rem 0.4rem;
        font-size: 1rem;
        font-weight: 400;
        color: #2c3e50;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        height: auto;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: #667eea;
        box-shadow:
            0 0 0 4px rgba(102, 126, 234, 0.1),
            0 4px 12px rgba(102, 126, 234, 0.15);
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: transparent;
    }

    .form-label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        font-weight: 500;
        color: #6c757d;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control:focus + .form-label,
    .form-control:not(:placeholder-shown) + .form-label {
        top: 0.5rem;
        font-size: 0.75rem;
        color: #667eea;
        font-weight: 600;
    }

    .form-label i {
        font-size: 1rem;
        color: #667eea;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
        padding-top: 1.5rem;
    }

    textarea.form-control + .form-label {
        top: 1.2rem;
    }

    textarea.form-control:focus + .form-label,
    textarea.form-control:not(:placeholder-shown) + .form-label {
        top: 0.5rem;
    }

    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 16px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        margin-top: 1rem;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow:
            0 10px 25px rgba(102, 126, 234, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .alert {
        border-radius: 16px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
        position: relative;
    }

    .alert-success {
        background: rgba(40, 167, 69, 0.1);
        color: #155724;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #721c24;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert li {
        margin-bottom: 0.5rem;
    }

    .alert i {
        margin-right: 0.5rem;
    }

    .is-invalid {
        border-color: #dc3545 !important;
        background: rgba(220, 53, 69, 0.05) !important;
    }

    .is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1) !important;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc3545;
        font-weight: 500;
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-elements::before,
    .floating-elements::after {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .floating-elements::before {
        top: 10%;
        left: 10%;
        animation-delay: -2s;
    }

    .floating-elements::after {
        bottom: 10%;
        right: 10%;
        animation-delay: -4s;
    }

    @media (max-width: 768px) {
        .contact-form {
            padding: 2rem 1.5rem;
            margin: 1rem;
        }

        .page-title {
            font-size: 2rem;
        }

        .form-control {
            padding: 1rem 0.75rem 0.3rem;
        }
    }
</style>

<div class="main-container">
    <div class="floating-elements"></div>

    <div class="form-wrapper">
        <h1 class="page-title">
            <i class="bi bi-envelope-heart-fill"></i>
            Liên hệ với chúng tôi
        </h1>

        {{-- Success/Error messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li><i class="bi bi-exclamation-circle-fill"></i>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('contact') }}" method="POST" class="contact-form" novalidate>
            @csrf

            {{-- Tên --}}
            <div class="form-floating">
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Nhập họ và tên"
                       required>
                <label for="name" class="form-label">
                    <i class="bi bi-person-circle"></i>
                    Họ và tên *
                </label>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="form-floating">
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="Nhập email"
                       required>
                <label for="email" class="form-label">
                    <i class="bi bi-envelope-at-fill"></i>
                    Email *
                </label>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tiêu đề --}}
            <div class="form-floating">
                <input type="text"
                       name="subject"
                       id="subject"
                       class="form-control @error('subject') is-invalid @enderror"
                       value="{{ old('subject') }}"
                       placeholder="Nhập tiêu đề">
                <label for="subject" class="form-label">
                    <i class="bi bi-tag-fill"></i>
                    Tiêu đề
                </label>
                @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Nội dung --}}
            <div class="form-floating">
                <textarea name="message"
                          id="message"
                          class="form-control @error('message') is-invalid @enderror"
                          placeholder="Nhập nội dung tin nhắn"
                          required>{{ old('message') }}</textarea>
                <label for="message" class="form-label">
                    <i class="bi bi-chat-left-text-fill"></i>
                    Nội dung *
                </label>
                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Nút gửi --}}
            <button type="submit" class="btn btn-submit">
                <i class="bi bi-send-check-fill me-2"></i>
                Gửi liên hệ
            </button>
        </form>
    </div>
</div>

<script>
// Enhance form interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add focus effects
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Add submit animation
    const form = document.querySelector('.contact-form');
    const submitBtn = document.querySelector('.btn-submit');

    form.addEventListener('submit', function() {
        submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i>Đang gửi...';
        submitBtn.disabled = true;
    });

    // Add typing effect for labels
    const labels = document.querySelectorAll('.form-label');
    labels.forEach(label => {
        label.addEventListener('animationend', function() {
            this.style.animation = 'none';
        });
    });
});
</script>
@endsection
