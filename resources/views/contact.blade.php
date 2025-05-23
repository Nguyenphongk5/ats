@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f6f7fb;
    }

    .contact-form {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease-in-out;
    }

    .contact-form:hover {
        transform: scale(1.005);
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 16px;
        box-shadow: none;
        border: 1px solid #ddd;
        transition: border-color 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
    }

    .btn-primary {
        padding: 12px;
        font-weight: 600;
        font-size: 17px;
        border-radius: 12px;
    }

    .input-group-text {
        background-color: #f0f1f6;
        border: none;
        border-radius: 12px 0 0 12px;
    }
</style>

<div class="container py-5" style="max-width: 720px;">
    <h1 class="text-center mb-4 fw-bold text-primary">
        <i class="bi bi-envelope-paper-heart-fill me-2"></i>Liên hệ với chúng tôi
    </h1>

    {{-- Success/Error messages --}}
    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $err)
                    <li><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('contact') }}" method="POST" class="contact-form mt-4" novalidate>
        @csrf

        {{-- Tên --}}
        <div class="mb-4">
            <label class="form-label"><i class="bi bi-person-circle me-1 text-primary"></i>Họ và tên *</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="form-label"><i class="bi bi-envelope-at-fill me-1 text-primary"></i>Email *</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Tiêu đề --}}
        <div class="mb-4">
            <label class="form-label"><i class="bi bi-tag-fill me-1 text-primary"></i>Tiêu đề</label>
            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                   value="{{ old('subject') }}">
            @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Nội dung --}}
        <div class="mb-4">
            <label class="form-label"><i class="bi bi-chat-left-text-fill me-1 text-primary"></i>Nội dung *</label>
            <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror"
                      required>{{ old('message') }}</textarea>
            @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Nút gửi --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary shadow">
                <i class="bi bi-send-check-fill me-2"></i>Gửi liên hệ
            </button>
        </div>
    </form>
</div>
@endsection
