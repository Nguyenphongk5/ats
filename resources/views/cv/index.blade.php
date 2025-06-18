@extends('layouts.app')

@section('content')
<div class="container px-4 px-md-5 py-5" style="max-width: 1140px;">
    <h1 class="text-center mb-5 fw-bold text-stylish-gradient display-4">
        🌟 Danh sách CV 🌟
    </h1>

   @if (!isset($jobId))
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
        <form method="GET" action="{{ route('cv.index') }}" class="d-flex flex-column flex-md-row align-items-md-center gap-3">
            <label for="job_id" class="fw-semibold text-secondary">Lọc theo Jobs:</label>
            <select name="job_id" id="job_id" class="form-select w-auto shadow-sm border border-primary-subtle">
                @foreach($jobs as $job)
                    <option value="{{ $job->id }}" {{ request('job_id') == $job->id ? 'selected' : '' }}>
                        {{ $job->title }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-funnel-fill me-1"></i> Lọc
            </button>
        </form>
    </div>
@else
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h5 class="text-secondary mb-0">Đã lọc theo công việc: <strong>{{ $jobs->firstWhere('id', $jobId)?->title ?? 'Không xác định' }}</strong></h5>
        <a href="{{ route('cv.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm d-flex align-items-center gap-1">
            <i class="bi bi-arrow-left-circle"></i> Quay lại
        </a>
    </div>
@endif


    @forelse($cvsGrouped as $jobId => $groupedCvs)
        <div class="mb-5">
            <h4 class="fw-bold text-primary d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-briefcase-fill fs-5"></i> Job:
                <span class="text-dark-emphasis">{{ $groupedCvs->first()->job?->title ?? 'Không xác định' }}</span>
                <span class="badge bg-info text-dark px-3 py-2 rounded-pill shadow">{{ count($groupedCvs) }} CV</span>
            </h4>

            <div class="table-responsive stylish-box">
                <table class="table table-hover stylish-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Họ tên</th>
                            <th>Năm sinh</th>
                            <th>Công ty gần nhất</th>
                            <th>Chức danh</th>
                            <th>Ngày nộp</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupedCvs as $cv)
                        <tr>
                            <td title="{{ $cv->full_name }}">{{ $cv->full_name ?? 'Không có' }}</td>
                            <td>{{ $cv->birth_year ?? 'Không có' }}</td>
                            <td title="{{ $cv->last_company }}">{{ $cv->last_company ?? 'Không có' }}</td>
                            <td title="{{ $cv->last_position }}">{{ $cv->last_position ?? 'Không có' }}</td>
                            <td><i class="bi bi-clock-history"></i> {{ $cv->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('cv.view', $cv->id) }}" target="_blank" class="btn btn-outline-success btn-sm rounded-pill shadow-sm">
                                    <i class="bi bi-eye-fill"></i> Xem CV
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center fs-5 rounded shadow-sm">
            Không có CV nào được nộp.
        </div>
    @endforelse
</div>

<style>
    .text-stylish-gradient {
        background: linear-gradient(135deg, #ff6a00, #ee0979);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .stylish-box {
        background: #ffffff;
        border: 2px dashed #ced4da;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        padding: 2rem;
    }
    .stylish-table {
        border-spacing: 0 15px;
    }
    .stylish-table thead th {
        background: #f1f3f5;
        border: none;
        border-radius: 10px;
        padding: 1rem;
        font-weight: 600;
        color: #495057;
    }
    .stylish-table tbody tr {
        background: #fdfdfe;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out;
    }
    .stylish-table tbody tr:hover {
        background: #eef3f8;
        transform: scale(1.01);
    }
    .stylish-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border: none;
    }
    .form-select.select-stylish {
        border: 2px solid #ced4da;
        border-radius: 14px;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        background-color: #f8f9fa;
    }
    .btn-gradient {
        background: linear-gradient(45deg, #00dbde, #fc00ff);
        color: #fff;
        font-weight: bold;
        border-radius: 14px;
        transition: 0.3s;
        border: none;
    }
    .btn-gradient:hover {
        filter: brightness(1.1);
    }
    .stylish-form label {
        font-size: 1.1rem;
    }
</style>
@endsection
