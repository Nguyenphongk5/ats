@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <h2 class="mb-4 text-primary fw-bold text-center">Form Nộp Đơn Ứng Tuyển</h2>

    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-4">
            <label for="full_name" class="form-label fw-semibold">Họ tên <span class="text-danger">*</span></label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                class="form-control @error('full_name') is-invalid @enderror"
                required
                placeholder="Nhập họ tên của bạn"
                value="{{ old('full_name') }}"
                autofocus
            >
            @error('full_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="birth_year" class="form-label fw-semibold">Năm sinh <span class="text-danger">*</span></label>
            <input
                type="number"
                id="birth_year"
                name="birth_year"
                class="form-control @error('birth_year') is-invalid @enderror"
                required
                min="1900"
                max="2100"
                placeholder="Ví dụ: 1990"
                value="{{ old('birth_year') }}"
            >
            @error('birth_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="last_company" class="form-label fw-semibold">Công ty gần nhất</label>
            <input
                type="text"
                id="last_company"
                name="last_company"
                class="form-control @error('last_company') is-invalid @enderror"
                placeholder="Tên công ty làm việc gần nhất"
                value="{{ old('last_company') }}"
            >
            @error('last_company')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="last_position" class="form-label fw-semibold">Chức danh gần nhất</label>
            <input
                type="text"
                id="last_position"
                name="last_position"
                class="form-control @error('last_position') is-invalid @enderror"
                placeholder="Chức danh bạn đảm nhiệm"
                value="{{ old('last_position') }}"
            >
            @error('last_position')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="cv" class="form-label fw-semibold">Tải CV <span class="text-danger">*</span></label>
            <input
                type="file"
                id="cv"
                name="cv"
                class="form-control @error('cv') is-invalid @enderror"
                accept=".pdf,.doc,.docx"
                required
            >
            <div class="form-text">Chỉ chấp nhận file PDF, DOC hoặc DOCX. Dung lượng tối đa 5MB.</div>
            @error('cv')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">
            <i class="bi bi-send-fill me-2"></i> Nộp đơn
        </button>
    </form>
</div>
@endsection
