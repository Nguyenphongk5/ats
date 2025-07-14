@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); min-height: 100vh; padding: 2rem 0;">
    <div class="container" style="max-width: 1100px;">

        {{-- Header Card --}}
        <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body p-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-6 fw-bold mb-3" style="font-family: 'Inter', sans-serif; letter-spacing: -0.02em;">
                            {{ $job->title }}
                        </h1>
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <div class="badge bg-white text-dark px-3 py-2 rounded-pill fw-semibold">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $job->start_date ? $job->start_date->format('d/m/Y') : 'Chưa cập nhật' }}
                            </div>
                            <div class="badge bg-white text-dark px-3 py-2 rounded-pill fw-semibold">
                                <i class="bi bi-clock me-1"></i>
                                {{ $job->end_date ? $job->end_date->format('d/m/Y') : 'Chưa cập nhật' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex justify-content-end gap-3 mb-3">
                            <div class="text-center">
                                <div class="h2 fw-bold mb-0">{{ $job->vacancy }}</div>
                                <small class="opacity-75">Headcounts</small>
                            </div>
                            <div class="text-center">
                                <span class="badge {{ $job->status === 'open' ? 'bg-success' : 'bg-danger' }} px-4 py-3 rounded-pill fs-6">
                                    {{ $job->status === 'open' ? 'Open' : 'Closed' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Success Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
                style="border-radius: 15px; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Statistics Cards --}}
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body text-center text-white p-3">
                                <div class="h4 fw-bold mb-1">{{ $job->cvs_count ?? $job->cvs()->count() }}</div>
                                <div class="small opacity-75">Apply</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                            <div class="card-body text-center text-dark p-3">
                                <div class="h4 fw-bold mb-1">{{ $job->qualified_count ?? 0 }}</div>
                                <div class="small opacity-75">Qualify</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                            <div class="card-body text-center text-dark p-3">
                                <div class="h4 fw-bold mb-1">{{ $job->interview1_count ?? 0 }}</div>
                                <div class="small opacity-75">Interview 1</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #d299c2 0%, #fef9d7 100%);">
                            <div class="card-body text-center text-dark p-3">
                                <div class="h4 fw-bold mb-1">{{ $job->interview2_count ?? 0 }}</div>
                                <div class="small opacity-75">Interview 2</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- More Statistics --}}
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);">
                            <div class="card-body text-center text-white p-3">
                                <div class="h4 fw-bold mb-1">{{ $job->offer_count ?? 0 }}</div>
                                <div class="small opacity-75">Offer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #fdbb2d 0%, #22c1c3 100%);">
                            <div class="card-body text-center text-white p-3">
                                <div class="h4 fw-bold mb-1">{{ $job->hand_count ?? 0 }}</div>
                                <div class="small opacity-75">Onboard</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Job Description --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-header bg-transparent border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0" style="color: #374151;">
                            <i class="bi bi-file-text me-2"></i>Job Description
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="job-description"
                             class="text-muted lh-lg"
                             style="font-size: 1rem; white-space: pre-line; cursor: pointer; max-height: 6.25rem; overflow: hidden; transition: max-height 0.3s ease;"
                             onclick="toggleDescription()">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                        <button class="btn btn-link p-0 mt-3 text-decoration-none fw-semibold"
                                onclick="toggleDescription()"
                                id="toggle-btn"
                                style="color: #667eea; font-size: 0.9rem;">
                            <i class="bi bi-chevron-down me-1"></i>Xem thêm
                        </button>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="border-radius: 20px; top: 2rem;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4" style="color: #374151;">
                            <i class="bi bi-gear me-2"></i>Actions
                        </h6>

                        <div class="d-grid gap-3">
                            @if ($job->status === 'open')
                                <a href="{{ route('jobs.apply', $job->id) }}"
                                   class="btn btn-lg fw-semibold text-white border-0 shadow-sm"
                                   style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem;">
                                    <i class="bi bi-plus-circle me-2"></i>Add CV
                                </a>
                            @endif

                            <a href="{{ route('cv.index.job', $job->id) }}"
                               class="btn btn-lg btn-outline-primary fw-semibold border-2 shadow-sm"
                               style="border-radius: 15px; padding: 1rem; border-color: #667eea; color: #667eea;">
                                <i class="bi bi-list-ul me-2"></i>List CV
                            </a>
                        </div>

                        {{-- Job Info --}}
                        <div class="mt-4 pt-4 border-top">
                            <h6 class="fw-bold mb-3" style="color: #374151;">
                                <i class="bi bi-info-circle me-2"></i>Job Information
                            </h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="text-center p-3 rounded-3" style="background: #f8fafc;">
                                        <div class="h6 fw-bold mb-1" style="color: #374151;">Open Date</div>
                                        <div class="small text-muted">{{ $job->start_date ? $job->start_date->format('d/m/Y') : 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center p-3 rounded-3" style="background: #f8fafc;">
                                        <div class="h6 fw-bold mb-1" style="color: #374151;">Close Date</div>
                                        <div class="small text-muted">{{ $job->end_date ? $job->end_date->format('d/m/Y') : 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const desc = document.getElementById('job-description');
    const btn = document.getElementById('toggle-btn');
    let collapsed = true;

    function toggleDescription() {
        if (collapsed) {
            // Mở rộng
            desc.style.maxHeight = desc.scrollHeight + "px";
            btn.innerHTML = '<i class="bi bi-chevron-up me-1"></i>Thu gọn';
        } else {
            // Thu gọn
            desc.style.maxHeight = "6.25rem";
            btn.innerHTML = '<i class="bi bi-chevron-down me-1"></i>Xem thêm';
        }
        collapsed = !collapsed;
    }
</script>

<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-1px);
    }
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
        font-family: 'Inter', sans-serif;
    }
</style>
@endsection
