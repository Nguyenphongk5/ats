@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white shadow-lg rounded-4 p-5 border border-light-subtle">
                <h2 class="mb-4 text-center text-primary fw-bold">🎯 Ứng tuyển: {{ $job->title }}</h2>

                <form action="{{ route('jobs.submitApplication', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="full_name" class="form-label fw-semibold">👤 Họ tên <span class="text-danger">*</span></label>
                        <input type="text" name="full_name" class="form-control rounded-pill px-4 py-2" placeholder="Nhập họ và tên" required>
                    </div>

                    <div class="mb-4">
                        <label for="birth_year" class="form-label fw-semibold">🎂 Năm sinh <span class="text-danger">*</span></label>
                        <input type="number" name="birth_year" class="form-control rounded-pill px-4 py-2" placeholder="Ví dụ: 1998" required min="1900" max="2100">
                    </div>

                    <div class="mb-4">
                        <label for="last_company" class="form-label fw-semibold">🏢 Công ty gần nhất</label>
                        <input type="text" name="last_company" class="form-control rounded-pill px-4 py-2" placeholder="Tên công ty gần đây">
                    </div>

                    <div class="mb-4">
                        <label for="last_position" class="form-label fw-semibold">💼 Chức danh gần nhất</label>
                        <input type="text" name="last_position" class="form-control rounded-pill px-4 py-2" placeholder="Ví dụ: Nhân viên Marketing">
                    </div>

                    <div class="mb-4">
                        <label for="cv" class="form-label fw-semibold">📎 Tải lên CV <span class="text-danger">*</span></label>
                        <input type="file" name="cv" class="form-control rounded-pill px-4 py-2" accept=".pdf,.doc,.docx" required>
                        <div class="form-text">Chỉ nhận file .pdf, .doc, .docx</div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow-sm">
                            🚀 Nộp đơn ngay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
