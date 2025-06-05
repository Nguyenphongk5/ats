@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #fff; min-height: 100vh;">
{{--
    <h2 class="mb-5 fw-bold text-primary border-bottom border-primary pb-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 2.25rem;">
        Chi tiết CV: <span class="text-secondary">{{ $cv->full_name ?? 'Ứng viên' }}</span>
    </h2> --}}

  <div class="card shadow-sm rounded-4 p-4 mb-5" style="background: #fff;">
    {{-- Thông tin cá nhân --}}
    <div class="mb-4">
        <h5 class="text-secondary fw-bold mb-3 text-center">Thông tin cá nhân ứng viên</h5>
        <div class="row text-center g-3">
            <div class="col-6 col-md-3">
                <div class="border rounded-3 p-3 h-100 shadow-sm bg-light">
                    <div class="text-muted mb-1" style="font-size: 0.9rem;">Họ tên</div>
                    <div class="fw-semibold" style="font-size: 1.1rem;">{{ $cv->full_name ?? 'Chưa có' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="border rounded-3 p-3 h-100 shadow-sm bg-light">
                    <div class="text-muted mb-1" style="font-size: 0.9rem;">Năm sinh</div>
                    <div class="fw-semibold" style="font-size: 1.1rem;">{{ $cv->birth_year ?? 'Chưa có' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="border rounded-3 p-3 h-100 shadow-sm bg-light">
                    <div class="text-muted mb-1" style="font-size: 0.9rem;">Công ty gần nhất</div>
                    <div class="fw-semibold" style="font-size: 1.1rem;">{{ $cv->last_company ?? 'Chưa có' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="border rounded-3 p-3 h-100 shadow-sm bg-light">
                    <div class="text-muted mb-1" style="font-size: 0.9rem;">Chức danh</div>
                    <div class="fw-semibold" style="font-size: 1.1rem;">{{ $cv->last_position ?? 'Chưa có' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Action cards --}}
    <div class="row g-4">
        @php
            $actions = [
                ['title'=>'Apply', 'date'=>$cv->created_at, 'btnClass'=>'btn-light', 'disabled'=>true, 'route'=>null],
                ['title'=>'Qualify', 'date'=>$cv->qualify_date, 'btnClass'=> $cv->qualified ? 'btn-success' : 'btn-outline-success', 'disabled'=>$cv->qualified, 'route'=>route('cv.qualify', $cv->id), 'name'=>'qualify_date'],
                ['title'=>'Phỏng vấn 1', 'date'=>$cv->interview1_date, 'btnClass'=>$cv->interview1 ? 'btn-warning' : 'btn-outline-warning', 'disabled'=>$cv->interview1, 'route'=>route('cv.interview1', $cv->id), 'name'=>'interview1_date'],
                ['title'=>'Phỏng vấn 2', 'date'=>$cv->interview2_date, 'btnClass'=>$cv->interview2 ? 'btn-info' : 'btn-outline-info', 'disabled'=>$cv->interview2, 'route'=>route('cv.interview2', $cv->id), 'name'=>'interview2_date'],
                ['title'=>'Offer', 'date'=>$cv->offer_date, 'btnClass'=>$cv->offer ? 'btn-warning' : 'btn-outline-warning', 'disabled'=>$cv->offer, 'route'=>route('cv.offer', $cv->id), 'name'=>'offer_date'],
                ['title'=>'Onboard', 'date'=>$cv->hand_date, 'btnClass'=>$cv->hand ? 'btn-danger' : 'btn-outline-danger', 'disabled'=>$cv->hand, 'route'=>route('cv.hand', $cv->id), 'name'=>'hand_date'],
            ];
        @endphp

       @foreach($actions as $index => $action)
<div class="col-6 col-md-4 col-lg-2">
    @if($action['route'])
    <form action="{{ $action['route'] }}" method="POST" class="mb-0">
        @csrf
        <div class="card h-100 border-0 bg-light shadow-sm rounded-3">
            <div class="card-body p-3 text-center d-flex flex-column justify-content-between position-relative">
                <h6 class="text-primary mb-2 fw-semibold">{{ $action['title'] }}</h6>

                <input
                    type="date"
                    name="{{ $action['name'] }}"
                    id="date-{{ $index }}"
                    class="form-control form-control-sm mb-2 rounded-pill text-center fw-semibold"
                    value="{{ $action['date'] ? \Carbon\Carbon::parse($action['date'])->format('Y-m-d') : '' }}"
                    {{ $action['disabled'] ? 'readonly' : '' }}
                    required
                    style="background-color: #e9ecef; border:1px solid #ced4da; color:#495057;"
                >

                {{-- Nút X để xóa ngày, chỉ hiện khi có giá trị và đang readonly --}}
                @if($action['date'] && $action['disabled'])
                <button
                    type="button"
                    class="btn btn-danger btn-sm position-absolute"
                    style="top: 10px; right: 10px; width: 24px; height: 24px; padding: 0; line-height: 1;"
                    onclick="clearDate({{ $index }})"
                    title="Xóa ngày và cho phép chọn lại"
                >×</button>
                @endif

                <button
                    type="submit"
                    class="btn {{ $action['btnClass'] }} w-100 rounded-pill fw-semibold"
                    {{ $action['disabled'] ? 'disabled' : '' }}>
                    {{ $action['title'] }}
                </button>
            </div>
        </div>
    </form>
    @else
    <div class="card h-100 border-0 bg-light shadow-sm rounded-3">
        <div class="card-body p-3 text-center d-flex flex-column justify-content-center">
            <h6 class="text-primary mb-2 fw-semibold">{{ $action['title'] }}</h6>
            <input
                type="date"
                class="form-control form-control-sm mb-2 rounded-pill text-center fw-semibold"
                value="{{ $action['date'] ? \Carbon\Carbon::parse($action['date'])->format('Y-m-d') : '' }}"
                readonly
                style="background-color: #dee2e6; border:1px solid #ced4da; color:#495057;"
            >
            <button class="btn btn-primary btn-sm w-100 rounded-pill fw-semibold" disabled>
                Apply
            </button>
        </div>
    </div>
    @endif
</div>
@endforeach

<script>
 function clearDate(index) {
    const input = document.getElementById('date-' + index);
    if (!input) return;
    // Xóa giá trị
    input.value = '';
    // Bỏ readonly để chọn lại
    input.removeAttribute('readonly');
    // Bật button submit (nếu có)
    const form = input.closest('form');
    if (form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.removeAttribute('disabled');
    }
    // Ẩn nút xóa
    event.target.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    // Khi chọn ngày mới, bỏ readonly và bật nút submit
    document.querySelectorAll('input[type=date]').forEach(input => {
        input.addEventListener('change', (e) => {
            if (input.value) {
                // Bỏ readonly để user có thể chỉnh lại nếu muốn
                input.removeAttribute('readonly');
                // Bật nút submit
                const form = input.closest('form');
                if (form) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) submitBtn.removeAttribute('disabled');
                }
                // Hiện nút X tương ứng
                const btnX = input.parentElement.querySelector('button.btn-danger');
                if (btnX) btnX.style.display = 'inline-block';
            }
        });
    });
});

</script>

    </div>
</div>



    {{-- File CV --}}
    @if(\Illuminate\Support\Str::endsWith($cv->file_path, '.pdf'))
    <iframe
        src="{{ asset('storage/' . $cv->file_path) }}"
        width="100%"
        height="650"
        class="rounded-4 shadow-sm mb-5"
        style="border:none; min-height:600px; background:#fff;"
    ></iframe>
    @else
    <p class="fs-5 mb-5 text-secondary">
        File CV:
        <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank" class="fw-bold text-primary text-decoration-underline">
            Tải xuống / Mở file
        </a>
    </p>
    @endif

    {{-- Form ghi chú --}}
    <div class="mb-5 pt-4 border-top border-secondary">
        <h4 class="mb-3 fw-semibold text-primary" style="font-size: 1.6rem;">
            Thêm ghi chú mới
        </h4>

        @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm" style="box-shadow:none;">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('cv.saveNote', $cv->id) }}" method="POST" class="mb-4">
            @csrf
            <textarea
                name="note"
                class="form-control rounded-3 bg-light text-secondary border-secondary fw-semibold"
                rows="5"
                placeholder="Nhập ghi chú tại đây..."
                style="font-size: 1.1rem;"
            ></textarea>
            @error('note')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" class="btn btn-primary mt-3 px-4 fw-semibold rounded-pill">
                <i class="bi bi-save me-1"></i> Lưu ghi chú
            </button>
        </form>
    </div>

    {{-- Lịch sử ghi chú --}}
    @if($cv->notes->count())
    <div class="mb-5">
        <h4 class="mb-4 fw-semibold text-primary" style="font-size: 1.6rem;">
            Lịch sử ghi chú
        </h4>
        <div class="d-flex flex-column gap-3">
            @foreach($cv->notes->sortByDesc('created_at') as $note)
            <div class="note-item p-3 rounded-4 shadow-sm" style="background:#f1f3f5; border-left: 6px solid #0d6efd; color:#212529;">
                <div class="fs-5 fw-semibold">{{ $note->note }}</div>
                <small class="opacity-75 fst-italic mt-2 d-block">
                    {{ $note->created_at->format('d/m/Y H:i') }}
                </small>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
        &larr; Quay lại
    </a>

</div>

<style>
    /* Card shadow */
    .action-card {
        transition: box-shadow 0.3s ease;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        background-color: #f9fafb !important;
        color: #212529 !important;
        border-radius: 1rem;
        border: 1px solid #dee2e6;
    }
    .action-card:hover {
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.3);
        cursor: pointer;
    }

    /* Table cell */
    .info-table table tbody tr td {
        border-right: 1px solid #ced4da;
        vertical-align: middle;
        padding: 1rem 1.5rem;
    }
    .info-table table tbody tr td:last-child {
        border-right: none;
    }

    /* Button */
    .btn-primary {
        background: #0d6efd;
        border-color: #0d6efd;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background: #0b5ed7;
        border-color: #0b5ed7;
    }

    /* Scrollbar Custom */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-thumb {
        background: #0d6efd;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-track {
        background: #e9ecef;
    }

    /* Note */
    .note-item {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f1f3f5 !important;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        color: #212529 !important;
        border-radius: 1rem;
        transition: box-shadow 0.3s ease;
    }
    .note-item:hover {
        box-shadow: 0 8px 30px rgba(13, 110, 253, 0.2);
    }

    /* Headings */
    h2, h4 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.action-card').forEach(card => {
            card.style.opacity = 0;
            setTimeout(() => {
                card.style.transition = 'opacity 0.8s ease-in';
                card.style.opacity = 1;
            }, 150);
        });
    });
</script>
@endsection
