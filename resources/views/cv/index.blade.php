@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <h1 class="text-center mb-5 fw-bold text-primary" style="font-size: 2.5rem; letter-spacing: 0.03em;">
            Danh sách CV
        </h1>

        <div class="row gy-5">
            @forelse($cvsGrouped as $jobId => $groupedCvs)
                {{-- Tiêu đề nhóm công việc --}}
                <div class="col-12 mb-3">
                    <h4 class="fw-semibold text-primary d-flex align-items-center gap-2" style="font-size: 1.4rem;">
                        <i class="bi bi-briefcase-fill"></i> Công việc: <span>{{ $groupedCvs->first()->job?->title ?? 'Không xác định' }}</span>
                        <span class="badge bg-secondary">{{ count($groupedCvs) }} CV</span>
                    </h4>
                </div>

                @foreach ($groupedCvs as $cv)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 d-flex flex-column justify-content-between" style="transition: 0.3s;">

                            <div class="card-body d-flex flex-column">

                                <ul class="list-unstyled mb-3 small text-secondary">
                                    <li class="mb-1"><strong>Họ tên:</strong> {{ $cv->full_name ?? 'Không có' }}</li>
                                    <li class="mb-1"><strong>Năm sinh:</strong> {{ $cv->birth_year ?? 'Không có' }}</li>
                                    <li class="mb-1"><strong>Công ty gần nhất:</strong> {{ $cv->last_company ?? 'Không có' }}</li>
                                    <li class="mb-1"><strong>Chức danh:</strong> {{ $cv->last_position ?? 'Không có' }}</li>
                                </ul>

                                <div class="d-flex flex-wrap gap-2 mb-3">

                                    <button type="button" class="btn btn-outline-primary btn-sm px-3 py-1 fw-semibold rounded-pill" style="min-width: 80px;">
                                        <i class="bi bi-upload"></i> Apply
                                    </button>

                                    <button type="button"
                                        class="btn btn-outline-success btn-sm px-3 py-1 fw-semibold rounded-pill qualify-btn"
                                        style="min-width: 80px;"
                                        data-cv-id="{{ $cv->id }}"
                                        {{ $cv->qualified ? 'disabled' : '' }}>
                                        <i class="bi bi-check-circle"></i> Qualify
                                    </button>

                                    <form action="{{ route('cv.interview1', $cv->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-outline-warning btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                                            style="min-width: 130px;">
                                            <i class="bi bi-calendar-check"></i> Phỏng vấn 1
                                        </button>
                                    </form>

                                    <form action="{{ route('cv.interview2', $cv->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-outline-info btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                                            style="min-width: 130px;">
                                            <i class="bi bi-calendar2-check-fill"></i> Phỏng vấn 2
                                        </button>
                                    </form>

                                    <form action="{{ route('cv.offer', $cv->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-outline-success btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                                            style="min-width: 110px;">
                                            <i class="bi bi-hand-thumbs-up"></i> Offer
                                        </button>
                                    </form>

                                    <form action="{{ route('cv.hand', $cv->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-outline-dark btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                                            style="min-width: 110px;">
                                            <i class="bi bi-box-arrow-in-down"></i> Hand
                                        </button>
                                    </form>
                                </div>

                                <p class="text-muted small fst-italic mb-4">
                                    <i class="bi bi-clock-history"></i> Ngày nộp: {{ $cv->created_at->format('d/m/Y H:i') }}
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('cv.view', $cv->id) }}" target="_blank"
                                        class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-2 rounded-pill shadow-sm"
                                        style="font-weight: 600; font-size: 0.95rem;">
                                        <i class="bi bi-file-earmark-text fs-5"></i> Xem CV
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

    {{-- Hiệu ứng hover --}}
    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Code JS của bạn ở đây
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.qualify-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const cvId = this.dataset.cvId;
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    fetch(`/cvs/${cvId}/qualify`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                            },
                            body: JSON.stringify({})
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.disabled = true;
                                alert('Đã đánh dấu !');

                                // Nếu muốn update số lượng qualified trên trang job:
                                // Ví dụ bạn có 1 span hiển thị số lượng, thì update nó ở đây
                                // document.querySelector('#qualifiedCountSpan').textContent = data.qualifiedCount;
                            } else {
                                alert('Có lỗi xảy ra, thử lại!');
                            }
                        })
                        .catch(() => alert('Lỗi kết nối!'));
                });
            });
        });
    </script>
@endpush
