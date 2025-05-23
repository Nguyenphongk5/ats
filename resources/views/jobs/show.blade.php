@extends('layouts.app')

@section('content')
<div class="py-5" style="max-width: 1200px; margin: 0 auto; padding-left: 15px; padding-right: 15px;">

    {{-- Nút thêm việc làm --}}

    {{-- Tiêu đề công việc --}}
    <h2 class="mb-5 fw-bold text-primary" style="font-size: 1.85rem; letter-spacing: 0.03em;">
        {{ $job->title }}
    </h2>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded shadow-sm mb-4" role="alert" style="font-size: 0.9rem;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Thời gian ứng tuyển --}}
    <div class="mb-4" style="font-size: 1rem;">
        <h6 class="fw-semibold text-secondary mb-2">⏳ Thời gian ứng tuyển</h6>
        <p class="text-muted mb-0">
            {{ $job->start_date ? $job->start_date->format('d/m/Y') : 'Chưa cập nhật' }}
        </p>
    </div>

    {{-- Mô tả công việc --}}
    <div class="border rounded-3 p-4 mb-5 shadow-sm" style="font-size: 1rem; white-space: pre-line; color: #333; background-color: #fafafa;">
        {!! nl2br(e($job->description)) !!}
    </div>

    {{-- Nút hành động --}}
   <div class="d-flex justify-content-start gap-3 flex-wrap align-items-center">
    <a href="{{ route('jobs.apply', $job->id) }}"
       class="btn btn-success btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
       style="font-size: 0.95rem; transition: background-color 0.3s ease;">
        <i class="bi bi-pencil-square me-2"></i> Ứng tuyển
    </a>
    <a href="{{ route('cv.index', $job->id) }}"
       class="btn btn-outline-primary btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
       style="font-size: 0.95rem; transition: color 0.3s ease, border-color 0.3s ease;">
        <i class="bi bi-card-list me-2"></i> Danh sách CV
    </a>
    <a href="{{ route('jobs.create') }}"
       class="btn btn-primary btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
       style="font-size: 0.95rem; transition: background-color 0.3s ease;">
        <i class="bi bi-plus-circle me-2"></i> Thêm việc làm
    </a>
</div>


</div>
@endsection
