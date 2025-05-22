@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h1 class="text-center mb-5 fw-bold text-primary" style="font-size: 2.5rem;">
        Danh sách CV
    </h1>

    <div class="row gy-4">
        @forelse($cvsGrouped as $jobId => $groupedCvs)
            {{-- Tiêu đề nhóm job --}}
          <div class="col-12 mb-3">
    <h4 class="fw-semibold text-primary" style="font-size: 1.4rem;">
        Công việc: {{ $groupedCvs->first()->job?->title ?? 'Không xác định' }}
        <span class="badge bg-secondary ms-2">{{ count($groupedCvs) }} CV</span>
    </h4>
</div>


            @foreach($groupedCvs as $cv)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body d-flex flex-column">

                            <ul class="list-unstyled small mb-3" style="font-size: 0.9rem; color: #333;">
                                <li><strong>Họ tên:</strong> {{ $cv->full_name ?? 'Không có' }}</li>
                                <li><strong>Năm sinh:</strong> {{ $cv->birth_year ?? 'Không có' }}</li>
                                <li><strong>Công ty gần nhất:</strong> {{ $cv->last_company ?? 'Không có' }}</li>
                                <li><strong>Chức danh:</strong> {{ $cv->last_position ?? 'Không có' }}</li>
                            </ul>

                            <p class="text-muted small mb-4" style="font-style: italic;">
                                Ngày nộp: {{ $cv->created_at->format('d/m/Y H:i') }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('cv.view', $cv->id) }}" target="_blank" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-file-earmark-text fs-5"></i> Xem CV
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center fs-5">
                    Không có CV nào được nộp.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
