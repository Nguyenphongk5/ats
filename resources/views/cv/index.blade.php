@extends('layouts.app')

@section('content')
<div class="container px-4 px-md-5 py-5" style="max-width: 1140px;">
    <h1 class="text-center mb-5 fw-bold text-primary" style="font-size: 2.5rem;">
        Danh sách CV
    </h1>
  @if (!isset($jobId))
    <div class="mb-6">
        <form method="GET" action="{{ route('cv.index') }}" class="flex flex-col md:flex-row md:items-center gap-3">
            <label for="job_id" class="font-semibold text-gray-700">Lọc theo Jobs:</label>
            <select name="job_id" id="job_id" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($jobs as $job)
                    <option value="{{ $job->id }}" {{ request('job_id') == $job->id ? 'selected' : '' }}>
                        {{ $job->title }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Lọc
            </button>
        </form>
    </div>
@endif




    @forelse($cvsGrouped as $jobId => $groupedCvs)
        <div class="card mb-5 border-0 shadow-sm rounded-4">
            <div class="card-header bg-light rounded-top-4 py-3 px-4">
                <h4 class="fw-semibold text-primary mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-briefcase-fill"></i> Job:
                    <span>{{ $groupedCvs->first()->job?->title ?? 'Không xác định' }}</span>
                    <span class="badge bg-secondary">{{ count($groupedCvs) }} CV</span>
                </h4>
            </div>

            <div class="card-body px-4 pb-4">
                <div class="row gy-4">
                    @foreach ($groupedCvs as $cv)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm rounded-3 hover-lift d-flex flex-column justify-content-between">
                                <div class="card-body d-flex flex-column">

                                    <ul class="list-unstyled mb-3 small text-secondary">
                                        <li><strong>Họ tên:</strong> {{ $cv->full_name ?? 'Không có' }}</li>
                                        <li><strong>Năm sinh:</strong> {{ $cv->birth_year ?? 'Không có' }}</li>
                                        <li><strong>Công ty gần nhất:</strong> {{ $cv->last_company ?? 'Không có' }}</li>
                                        <li><strong>Chức danh:</strong> {{ $cv->last_position ?? 'Không có' }}</li>
                                    </ul>

                                    <p class="text-muted small fst-italic mt-auto">
                                        <i class="bi bi-clock-history"></i> Nộp: {{ $cv->created_at->format('d/m/Y H:i') }}
                                    </p>

                                    <a href="{{ route('cv.view', $cv->id) }}" target="_blank"
                                       class="btn btn-sm btn-outline-primary w-100 mt-2 rounded-pill fw-semibold d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-file-earmark-text"></i> View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center fs-5 rounded shadow-sm">
            Không có CV nào được nộp.
        </div>
    @endforelse
</div>

<style>
    .hover-lift {
        transition: 0.3s;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
