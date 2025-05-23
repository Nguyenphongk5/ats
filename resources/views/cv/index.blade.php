@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h1 class="text-center mb-5 fw-bold text-primary" style="font-size: 2.5rem; letter-spacing: 0.03em;">
        Danh sách CV
    </h1>

    <div class="row gy-4">
        @forelse($cvsGrouped as $jobId => $groupedCvs)
            {{-- Tiêu đề nhóm job --}}
            <div class="col-12 mb-4">
                <h4 class="fw-semibold text-primary d-flex align-items-center" style="font-size: 1.4rem; gap: 0.5rem;">
                    Công việc: <span class="ms-2">{{ $groupedCvs->first()->job?->title ?? 'Không xác định' }}</span>
                    <span class="badge bg-secondary">{{ count($groupedCvs) }} CV</span>
                </h4>
            </div>

            @foreach($groupedCvs as $cv)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body d-flex flex-column">

                            <ul class="list-unstyled mb-4" style="font-size: 0.9rem; color: #444;">
                                <li><strong>Họ tên:</strong> {{ $cv->full_name ?? 'Không có' }}</li>
                                <li><strong>Năm sinh:</strong> {{ $cv->birth_year ?? 'Không có' }}</li>
                                <li><strong>Công ty gần nhất:</strong> {{ $cv->last_company ?? 'Không có' }}</li>
                                <li><strong>Chức danh:</strong> {{ $cv->last_position ?? 'Không có' }}</li>
                            </ul>

                            <p class="text-muted small fst-italic mb-4">
                                Ngày nộp: {{ $cv->created_at->format('d/m/Y H:i') }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('cv.view', $cv->id) }}" target="_blank"
                                   class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-2 rounded-pill shadow-sm"
                                   style="font-weight: 600; font-size: 0.95rem; transition: background-color 0.3s ease;">
                                    <i class="bi bi-file-earmark-text fs-5"></i> View
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center fs-5 rounded shadow-sm">
                    Không có CV nào được nộp.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
