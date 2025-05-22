@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <h2 class="mb-4 text-primary fw-bold text-center">Thêm công việc mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.storeJob') }}" method="POST" novalidate>
        @csrf

        {{-- Tên công việc --}}
        <div class="mb-4">
            <label for="title" class="form-label fw-semibold">Tên công việc <span class="text-danger">*</span></label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}"
                required
                placeholder="Nhập tên công việc"
                autofocus
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Mô tả --}}
        <div class="mb-4">
            <label for="description" class="form-label fw-semibold">Mô tả</label>
            <textarea
                id="description"
                name="description"
                rows="4"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Mô tả công việc (tùy chọn)"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ngày bắt đầu --}}
        <div class="mb-4">
            <label for="start_date" class="form-label fw-semibold">Ngày bắt đầu <span class="text-danger">*</span></label>
            <input
                type="date"
                id="start_date"
                name="start_date"
                class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date') }}"
                required
            >
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Chọn công ty --}}
        <div class="mb-4">
            <label for="company_id" class="form-label fw-semibold">Công ty <span class="text-danger">*</span></label>
            <select
                id="company_id"
                name="company_id"
                class="form-select @error('company_id') is-invalid @enderror"
                required
            >
                <option value="" disabled {{ old('company_id') ? '' : 'selected' }}>-- Chọn công ty --</option>
                @foreach($companies as $company)
                    <option
                        value="{{ $company->id }}"
                        {{ old('company_id') == $company->id ? 'selected' : '' }}
                    >
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Trạng thái công việc --}}
        <div class="mb-4">
            <label for="status" class="form-label fw-semibold">Trạng thái <span class="text-danger">*</span></label>
            <select
                id="status"
                name="status"
                class="form-select @error('status') is-invalid @enderror"
                required
            >
                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Đang mở</option>
                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Đã đóng</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Loại công việc --}}
        <div class="mb-4">
            <label for="type" class="form-label fw-semibold">Loại công việc <span class="text-danger">*</span></label>
            <select
                id="type"
                name="type"
                class="form-select @error('type') is-invalid @enderror"
                required
            >
                <option value="manager" {{ old('type', 'specialist') == 'manager' ? 'selected' : '' }}>Quản lý</option>
                <option value="specialist" {{ old('type', 'specialist') == 'specialist' ? 'selected' : '' }}>Chuyên viên</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left-circle me-2"></i> Quay lại
            </a>
            <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm">
                <i class="bi bi-plus-circle me-2"></i> Thêm công việc
            </button>
        </div>
    </form>
</div>
@endsection
