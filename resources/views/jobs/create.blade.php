@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 750px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body px-5 py-4">
            <h2 class="mb-4 text-center text-primary fw-bold">
                <i class="bi bi-briefcase-fill me-2"></i> Thêm Công Việc Mới
            </h2>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3 shadow-sm">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li><i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="jobForm" action="{{ route('jobs.storeJob') }}" method="POST" novalidate>
                @csrf

                {{-- Tên công việc --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">📝 Tên công việc <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control rounded-3 shadow-sm @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        required
                        placeholder="VD: Lập trình viên Backend"
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Mô tả --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">📄 Mô tả</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control rounded-3 shadow-sm @error('description') is-invalid @enderror"
                        rows="4"
                        placeholder="Nhập mô tả công việc"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ngày bắt đầu --}}
                <div class="mb-3">
                    <label for="start_date" class="form-label fw-semibold">📅 Ngày bắt đầu <span class="text-danger">*</span></label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        class="form-control rounded-3 shadow-sm @error('start_date') is-invalid @enderror"
                        value="{{ old('start_date') }}"
                        required
                    >
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Công ty --}}
                <div class="mb-3">
                    <label for="company_id" class="form-label fw-semibold">🏢 Công ty <span class="text-danger">*</span></label>
                    <select
                        id="company_id"
                        name="company_id"
                        class="form-select rounded-3 shadow-sm @error('company_id') is-invalid @enderror"
                        required
                    >
                        <option disabled selected>-- Chọn công ty --</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Trạng thái --}}
                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold">🔒 Trạng thái <span class="text-danger">*</span></label>
                    <select
                        id="status"
                        name="status"
                        class="form-select rounded-3 shadow-sm @error('status') is-invalid @enderror"
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
                <div class="mb-3">
                    <label for="type" class="form-label fw-semibold">👤 Loại công việc <span class="text-danger">*</span></label>
                    <select
                        id="type"
                        name="type"
                        class="form-select rounded-3 shadow-sm @error('type') is-invalid @enderror"
                        required
                    >
                        <option value="manager" {{ old('type') == 'manager' ? 'selected' : '' }}>Quản lý</option>
                        <option value="specialist" {{ old('type') == 'specialist' ? 'selected' : '' }}>Chuyên viên</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
    <label for="vacancy" class="form-label">Số lượng cần tuyển</label>
    <input type="number" name="vacancy" id="vacancy" class="form-control" min="1" value="{{ old('vacancy', $job->vacancy ?? 1) }}" required>
</div>


                {{-- Nút --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="bi bi-arrow-left-circle me-2"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary px-4 rounded-pill fw-semibold shadow">
                        <i class="bi bi-plus-circle me-2"></i> Thêm công việc
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('jobForm');

        form.addEventListener('submit', function (e) {
            const title = form.querySelector('#title').value.trim();
            const startDate = form.querySelector('#start_date').value;
            const company = form.querySelector('#company_id').value;

            if (!title || !startDate || !company) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin bắt buộc.');
            }
        });
    });
</script>
@endpush
