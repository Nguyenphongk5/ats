@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #ffffff; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-11">

            {{-- Header Card --}}
            <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow: hidden;">
             <div class="card border-0 shadow-sm mb-4"
     style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="card-body p-5">
        <div class="row text-white" style="min-height: 120px;">
    {{-- Thông tin ứng viên --}}
    <div class="col-md-8 d-flex flex-column justify-content-between">
        <div class="d-flex align-items-center mb-3">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center me-4"
                style="width: 56px; height: 56px;">
                <i class="bi bi-person-badge fs-3 text-white"></i>
            </div>
            <div>
                @if ($cv->job)
                    <span class="badge bg-white bg-opacity-25 text-white mb-2 px-3 py-2 fw-semibold"
                          style="font-size: 0.85rem; letter-spacing: 0.5px;">
                        {{ $cv->job->title }}
                    </span>
                @endif
                <h3 class="mb-0 fw-bold" style="font-size: 1.75rem;">
                    {{ $cv->full_name ?? 'Ứng viên' }}
                </h3>
            </div>
        </div>
      <div class="row g-4">
    <div class="col-md-4">
        <div class="d-flex align-items-start">
            <i class="bi bi-calendar-event me-3 fs-5 mt-1"></i>
            <div>
                <div class="small text-white-50">Năm sinh</div>
                <div class="fw-semibold fs-6">{{ $cv->birth_year ?? 'Chưa có' }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="d-flex align-items-start">
            <i class="bi bi-building me-3 fs-5 mt-1"></i>
            <div>
                <div class="small text-white-50">Công ty gần nhất</div>
                <div class="fw-semibold fs-6">{{ $cv->last_company ?? 'Chưa có' }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="d-flex align-items-start">
            <i class="bi bi-briefcase me-3 fs-5 mt-1"></i>
            <div>
                <div class="small text-white-50">Chức danh gần nhất</div>
                <div class="fw-semibold fs-6">{{ $cv->last_position ?? 'Chưa có' }}</div>
            </div>
        </div>
    </div>
</div>


    </div>

    {{-- Chức danh gần nhất --}}

    </div>
</div>

            </div>

            {{-- Process Steps --}}
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 20px; border: 1px solid #e9ecef;">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-diagram-3 text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-0 fw-bold text-dark">Quy trình tuyển dụng</h4>
                    </div>

                    @php
                        $actions = [
                            [
                                'title' => 'Apply',
                                'icon' => 'bi-send-fill',
                                'date' => $cv->created_at,
                                'btnClass' => 'btn-primary',
                                'bgClass' => 'bg-primary',
                                'disabled' => true,
                                'route' => route('cv.updateApply', $cv->id),
                                'name' => 'created_at',
                            ],
                            [
                                'title' => 'Qualify',
                                'icon' => 'bi-check-circle-fill',
                                'date' => $cv->qualify_date,
                                'btnClass' => $cv->qualified ? 'btn-success' : 'btn-outline-success',
                                'bgClass' => 'bg-success',
                                'disabled' => $cv->qualified,
                                'route' => route('cv.qualify', $cv->id),
                                'name' => 'qualify_date',
                            ],
                            [
                                'title' => 'Phỏng vấn 1',
                                'icon' => 'bi-chat-dots-fill',
                                'date' => $cv->interview1_date,
                                'btnClass' => $cv->interview1 ? 'btn-warning' : 'btn-outline-warning',
                                'bgClass' => 'bg-warning',
                                'disabled' => $cv->interview1,
                                'route' => route('cv.interview1', $cv->id),
                                'name' => 'interview1_date',
                            ],
                            [
                                'title' => 'Phỏng vấn 2',
                                'icon' => 'bi-chat-square-dots-fill',
                                'date' => $cv->interview2_date,
                                'btnClass' => $cv->interview2 ? 'btn-info' : 'btn-outline-info',
                                'bgClass' => 'bg-info',
                                'disabled' => $cv->interview2,
                                'route' => route('cv.interview2', $cv->id),
                                'name' => 'interview2_date',
                            ],
                            [
                                'title' => 'Offer',
                                'icon' => 'bi-gift-fill',
                                'date' => $cv->offer_date,
                                'btnClass' => $cv->offer ? 'btn-warning' : 'btn-outline-warning',
                                'bgClass' => 'bg-warning',
                                'disabled' => $cv->offer,
                                'route' => route('cv.offer', $cv->id),
                                'name' => 'offer_date',
                            ],
                            [
                                'title' => 'Onboard',
                                'icon' => 'bi-person-check-fill',
                                'date' => $cv->hand_date,
                                'btnClass' => $cv->hand ? 'btn-success' : 'btn-outline-success',
                                'bgClass' => 'bg-success',
                                'disabled' => $cv->hand,
                                'route' => route('cv.hand', $cv->id),
                                'name' => 'hand_date',
                            ],
                        ];
                    @endphp

                    <div class="row g-4 justify-content-center">
                        @foreach ($actions as $index => $action)
                            <div class="col-6 col-md-4 col-lg-2">
                                @if ($action['route'])
                                    <form action="{{ $action['route'] }}" method="POST" class="mb-0">
                                        @csrf
                                        <div class="card h-100 border-0 shadow-sm position-relative hover-lift" style="border-radius: 16px; border: 1px solid #e9ecef;">
                                            <div class="card-body p-4 text-center">
                                                {{-- Icon --}}


                                                {{-- Title --}}
                                                <h6 class="text-dark mb-3 fw-semibold">{{ $action['title'] }}</h6>

                                                {{-- Date Input --}}
                                                <input type="date" name="{{ $action['name'] }}" id="date-{{ $index }}"
                                                    class="form-control form-control-sm mb-3 text-center fw-medium border-0 bg-light"
                                                    value="{{ $action['date'] ? \Carbon\Carbon::parse($action['date'])->format('Y-m-d') : '' }}"
                                                    {{ $action['disabled'] ? 'readonly' : '' }} required
                                                    style="border-radius: 10px; font-size: 0.85rem;">

                                                {{-- Clear Button --}}
                                                @if ($action['date'])
                                                    <button type="button" class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2 rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 28px; height: 28px; padding: 0; font-size: 0.75rem;"
                                                        onclick="clearDate({{ $index }})"
                                                        title="Xóa ngày">
                                                        <i class="bi bi-x">x</i>
                                                    </button>
                                                @endif

                                                {{-- Submit Button --}}
                                                <button type="submit" class="btn {{ $action['btnClass'] }} btn-sm w-100 fw-medium"
                                                    {{ $action['disabled'] ? 'disabled' : '' }}
                                                    style="border-radius: 10px; font-size: 0.85rem; padding: 0.5rem;">
                                                    <i class="{{ $action['icon'] }} me-1"></i>
                                                    {{ $action['title'] }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; border: 1px solid #e9ecef;">
                                        <div class="card-body p-4 text-center">
                                            <div class="mb-3">
                                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10" style="width: 50px; height: 50px;">
                                                    <i class="{{ $action['icon'] }} text-primary fs-5"></i>
                                                </div>
                                            </div>
                                            <h6 class="text-dark mb-3 fw-semibold">{{ $action['title'] }}</h6>
                                            <input type="date" class="form-control form-control-sm mb-3 text-center fw-medium border-0 bg-light"
                                                value="{{ $action['date'] ? \Carbon\Carbon::parse($action['date'])->format('Y-m-d') : '' }}"
                                                readonly style="border-radius: 10px; font-size: 0.85rem;">
                                            <button class="btn btn-primary btn-sm w-100 fw-medium" disabled style="border-radius: 10px; font-size: 0.85rem; padding: 0.5rem;">
                                                <i class="{{ $action['icon'] }} me-1"></i>
                                                Apply
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CV File & Notes Row --}}
            <div class="row g-4">
                {{-- CV File --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; border: 1px solid #e9ecef;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                                    <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>
                                </div>
                                <h4 class="mb-0 fw-bold text-dark">Hồ sơ CV</h4>
                            </div>

                            @if (\Illuminate\Support\Str::endsWith($cv->file_path, '.pdf'))
                                <div class="pdf-viewer" style="border-radius: 16px; overflow: hidden; border: 1px solid #e9ecef;">
                                    <iframe src="{{ asset('storage/' . $cv->file_path) }}" width="100%" height="600"
                                        class="border-0" style="background:#fff;"></iframe>
                                </div>
                            @else
                                <div class="text-center py-5" style="background: #f8f9fa; border-radius: 16px;">
                                    <div class="mb-4">
                                        <i class="bi bi-download text-primary" style="font-size: 4rem;"></i>
                                    </div>
                                    <h5 class="mb-3 text-muted">File CV không thể xem trước</h5>
                                    <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank"
                                        class="btn btn-primary btn-lg fw-semibold shadow-sm" style="border-radius: 12px; padding: 1rem 2rem;">
                                        <i class="bi bi-download me-2"></i>
                                        Tải xuống CV
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Notes Section --}}
                <div class="col-lg-4">
                    {{-- Add Note Form --}}
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; border: 1px solid #e9ecef;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                    <i class="bi bi-chat-left-text text-success fs-4"></i>
                                </div>
                                <h5 class="mb-0 fw-bold text-dark">Thêm ghi chú</h5>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success border-0 rounded-3 mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('cv.saveNote', $cv->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark mb-2">Nội dung ghi chú</label>
                                    <textarea name="note" class="form-control border-0 bg-light" rows="4"
                                        placeholder="Nhập ghi chú chi tiết về ứng viên..."
                                        style="border-radius: 12px; resize: none; font-size: 0.95rem;"></textarea>
                                    @error('note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-2">Nguồn ứng viên</label>
                                    <select name="source" class="form-select border-0 bg-light" style="border-radius: 12px; font-size: 0.95rem;">
                                        <option value="">-- Chọn nguồn --</option>
                                        <option value="LinkedIn">LinkedIn</option>
                                        <option value="Website">Website</option>
                                        <option value="Giới thiệu nội bộ">Giới thiệu nội bộ</option>
                                        <option value="Tuyển dụng trực tiếp">Tuyển dụng trực tiếp</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success w-100 fw-semibold py-3 shadow-sm" style="border-radius: 12px;">
                                    <i class="bi bi-save me-2"></i>
                                    Lưu ghi chú
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Notes History --}}
                    @if ($cv->notes->count())
                        <div class="card border-0 shadow-sm" style="border-radius: 20px; border: 1px solid #e9ecef;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                                        <i class="bi bi-clock-history text-info fs-4"></i>
                                    </div>
                                    <h5 class="mb-0 fw-bold text-dark">Lịch sử ghi chú</h5>
                                </div>

                                <div class="notes-container" style="max-height: 450px; overflow-y: auto;">
                                    @foreach ($cv->notes->sortByDesc('created_at') as $note)
                                        <div class="note-item p-3 mb-3 border-0 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                            <div class="mb-2 fw-medium text-dark" style="font-size: 0.95rem; line-height: 1.5;">
                                                {{ $note->note }}
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="text-muted d-flex align-items-center">
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    {{ $note->created_at->format('d/m/Y H:i') }}
                                                </small>
                                                @if ($note->source)
                                                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $note->source }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="text-center mt-5">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-lg fw-semibold shadow-sm" style="border-radius: 12px; padding: 1rem 2rem;">
                    <i class="bi bi-arrow-left me-2"></i>
                    Quay lại
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    function clearDate(index) {
        const input = document.getElementById('date-' + index);
        if (!input) return;

        input.value = '';
        input.removeAttribute('readonly');

        const form = input.closest('form');
        if (form) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.removeAttribute('disabled');
        }

        event.target.style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Enhanced hover effects
        document.querySelectorAll('.hover-lift').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
                card.style.boxShadow = '0 15px 35px rgba(0,0,0,0.1)';
                card.style.transition = 'all 0.3s ease';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '0 0.125rem 0.25rem rgba(0,0,0,0.075)';
            });
        });

        // Date input handlers
        document.querySelectorAll('input[type=date]').forEach(input => {
            input.addEventListener('change', (e) => {
                if (input.value) {
                    input.removeAttribute('readonly');
                    const form = input.closest('form');
                    if (form) {
                        const submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn) submitBtn.removeAttribute('disabled');
                    }
                    const btnX = input.parentElement.querySelector('button.btn-outline-danger');
                    if (btnX) btnX.style.display = 'flex';
                }
            });
        });

        // Smooth scrolling for notes
        document.querySelectorAll('.notes-container').forEach(container => {
            container.style.scrollBehavior = 'smooth';
        });
    });
</script>

<style>
    body {
        background: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .notes-container::-webkit-scrollbar {
        width: 8px;
    }

    .notes-container::-webkit-scrollbar-track {
        background: #f1f3f4;
        border-radius: 10px;
    }

    .notes-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }

    .notes-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }

    .note-item {
        border-left: 4px solid #667eea !important;
        transition: all 0.3s ease;
    }

    .note-item:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn {
        transition: all 0.3s ease;
        border-width: 2px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        border-color: #667eea;
        background: #fff;
    }

    .pdf-viewer {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .alert {
        border-left: 4px solid #28a745;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
    }

    .container {
        max-width: 1400px;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }

        .col-lg-2 {
            min-width: 160px;
        }
    }
</style>
@endsection
