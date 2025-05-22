@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Nút thêm việc làm --}}
    <div class="mb-3 d-flex justify-content-start">
        <a href="{{ route('jobs.create') }}" class="btn btn-primary shadow-sm rounded px-3 py-1 fw-semibold" style="font-size: 0.9rem;">
            <i class="bi bi-plus-circle me-1"></i> Thêm việc làm
        </a>
    </div>

    {{-- Tiêu đề công việc --}}
    <h2 class="mb-3 fw-bold text-primary" style="text-align: left; font-size: 1.75rem;">
        {{ $job->title }}
    </h2>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded shadow-sm" role="alert" style="font-size: 0.9rem;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Thời gian ứng tuyển --}}
    <div class="mb-4" style="text-align: left; font-size: 0.95rem;">
        <h6 class="fw-semibold text-secondary mb-1">Thời gian ứng tuyển</h6>
        <p class="text-muted mb-0">
            {{ $job->start_date ? $job->start_date->format('d/m/Y') : 'Chưa cập nhật' }}
        </p>
    </div>

    {{-- Mô tả công việc --}}
    <div class="border rounded p-3 mb-4" style="font-size: 0.95rem; white-space: pre-line; color: #444;">
        {!! nl2br(e($job->description)) !!}
    </div>

    {{-- Nút hành động --}}
    <div class="d-flex justify-content-start gap-3">
        <a href="{{ route('jobs.apply', $job->id) }}" class="btn btn-success btn-sm px-4 fw-semibold" style="font-size: 0.9rem;">
            <i class="bi bi-pencil-square me-1"></i> Ứng tuyển
        </a>
        <a href="{{ route('cv.index', $job->id) }}" class="btn btn-outline-primary btn-sm px-4 fw-semibold" style="font-size: 0.9rem;">
            <i class="bi bi-card-list me-1"></i> Danh sách CV
        </a>
    </div>
</div>
@endsection
