@extends('layouts.app')

@section('content')



    <h2 class="mb-4 fw-bold text-primary pb-2" style="font-size: 2rem; border-bottom: none;">
        Chi tiết CV của {{ $cv->full_name ?? 'Ứng viên' }}
    </h2>
    {{-- <div class="mb-3">
        <a href="{{ route('cv.chart') }}" class="btn btn-secondary">Quay lại biểu đồ</a>
    </div> --}}

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">

    {{-- Mỗi hành động là 1 "card" nhỏ --}}
  <div class="container px-0">
    <div class="row g-3">

        {{-- Apply --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-3">
                    <h6 class="card-title text-muted small mb-2">Apply</h6>
                    <input type="date"
                        class="form-control form-control-sm mb-2"
                        value="{{ $cv->created_at ? \Carbon\Carbon::parse($cv->created_at)->format('Y-m-d') : '' }}"
                        readonly>
                    <button class="btn btn-outline-primary btn-sm w-100 rounded-pill" disabled>
                        <i class="bi bi-upload"></i> Applied
                    </button>
                </div>
            </div>
        </div>

        {{-- Qualify --}}
        <div class="col-md-4">
            <form action="{{ route('cv.qualify', $cv->id) }}" method="POST">
                @csrf
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="card-title text-muted small mb-2">Qualify</h6>
                        <input type="date" name="qualify_date"
                            class="form-control form-control-sm mb-2"
                            value="{{ $cv->qualify_date ? \Carbon\Carbon::parse($cv->qualify_date)->format('Y-m-d') : '' }}"
                            {{ $cv->qualified ? 'readonly' : '' }}
                            required>
                        <button type="submit"
                            class="btn btn-sm w-100 rounded-pill {{ $cv->qualified ? 'btn-success text-white' : 'btn-outline-success' }}"
                            {{ $cv->qualified ? 'disabled' : '' }}>
                            Qualify
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Phỏng vấn 1 --}}
        <div class="col-md-4">
            <form action="{{ route('cv.interview1', $cv->id) }}" method="POST">
                @csrf
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="card-title text-muted small mb-2">Phỏng vấn 1</h6>
                        <input type="date" name="interview1_date"
                            class="form-control form-control-sm mb-2"
                            value="{{ $cv->interview1_date ? \Carbon\Carbon::parse($cv->interview1_date)->format('Y-m-d') : '' }}"
                            {{ $cv->interview1 ? 'readonly' : '' }}
                            required>
                        <button type="submit"
                            class="btn btn-sm w-100 rounded-pill {{ $cv->interview1 ? 'btn-warning text-white' : 'btn-outline-warning' }}"
                            {{ $cv->interview1 ? 'disabled' : '' }}>
                            Phỏng vấn 1
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Phỏng vấn 2 --}}
        <div class="col-md-4">
            <form action="{{ route('cv.interview2', $cv->id) }}" method="POST">
                @csrf
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="card-title text-muted small mb-2">Phỏng vấn 2</h6>
                        <input type="date" name="interview2_date"
                            class="form-control form-control-sm mb-2"
                            value="{{ $cv->interview2_date ? \Carbon\Carbon::parse($cv->interview2_date)->format('Y-m-d') : '' }}"
                            {{ $cv->interview2 ? 'readonly' : '' }}
                            required>
                        <button type="submit"
                            class="btn btn-sm w-100 rounded-pill {{ $cv->interview2 ? 'btn-info text-white' : 'btn-outline-info' }}"
                            {{ $cv->interview2 ? 'disabled' : '' }}>
                            Phỏng vấn 2
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Offer --}}
        <div class="col-md-4">
            <form action="{{ route('cv.offer', $cv->id) }}" method="POST">
                @csrf
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="card-title text-muted small mb-2">Offer</h6>
                        <input type="date" name="offer_date"
                            class="form-control form-control-sm mb-2"
                            value="{{ $cv->offer_date ? \Carbon\Carbon::parse($cv->offer_date)->format('Y-m-d') : '' }}"
                            {{ $cv->offer ? 'readonly' : '' }}
                            required>
                        <button type="submit"
                            class="btn btn-sm w-100 rounded-pill {{ $cv->offer ? 'btn-primary text-white' : 'btn-outline-primary' }}"
                            {{ $cv->offer ? 'disabled' : '' }}>
                            Offer
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Hand --}}
        <div class="col-md-4">
            <form action="{{ route('cv.hand', $cv->id) }}" method="POST">
                @csrf
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="card-title text-muted small mb-2">Hand</h6>
                        <input type="date" name="hand_date"
                            class="form-control form-control-sm mb-2"
                            value="{{ $cv->hand_date ? \Carbon\Carbon::parse($cv->hand_date)->format('Y-m-d') : '' }}"
                            {{ $cv->hand ? 'readonly' : '' }}
                            required>
                        <button type="submit"
                            class="btn btn-sm w-100 rounded-pill {{ $cv->hand ? 'btn-dark text-white' : 'btn-outline-dark' }}"
                            {{ $cv->hand ? 'disabled' : '' }}>
                            Hand
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>



</div>

    <div class="mb-4 p-4 rounded-4" style="max-width: 520px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #34495e; background-color: #fefefe;">
        <p class="mb-3 fs-5"><strong>Họ tên:</strong> <span class="text-dark">{{ $cv->full_name ?? 'Không có' }}</span></p>
        <p class="mb-3 fs-5"><strong>Năm sinh:</strong> <span class="text-dark">{{ $cv->birth_year ?? 'Không có' }}</span></p>
        <p class="mb-3 fs-5"><strong>Công ty gần nhất:</strong> <span class="text-dark">{{ $cv->last_company ?? 'Không có' }}</span></p>
        <p class="mb-0 fs-5"><strong>Chức danh:</strong> <span class="text-dark">{{ $cv->last_position ?? 'Không có' }}</span></p>
    </div>

    @if(\Illuminate\Support\Str::endsWith($cv->file_path, '.pdf'))
        <div class="mb-5">
            <iframe src="{{ asset('storage/' . $cv->file_path) }}" width="100%" height="650" class="rounded-4" style="min-height: 600px; border:none;"></iframe>
        </div>
    @else
        <div class="mb-5">
            <p class="fs-5">
                File CV:
                <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank" class="text-decoration-none fw-semibold text-primary">
                    Tải xuống / Mở file
                </a>
            </p>
        </div>
    @endif

    {{-- Form ghi chú --}}
    <div class="mb-5 pt-4" style="border-top: none;">
        <h4 class="mb-3 fw-semibold text-primary ps-0" style="font-size: 1.5rem;">
            Thêm ghi chú mới
        </h4>

        @if(session('success'))
            <div class="alert alert-success rounded-3" style="box-shadow:none;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cv.saveNote', $cv->id) }}" method="POST" class="mb-4">
            @csrf
            <textarea name="note" class="form-control rounded-3" rows="5" placeholder="Nhập ghi chú tại đây..." style="font-size: 1rem; border:none; background-color:#f9f9f9;"></textarea>
            @error('note')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" class="btn btn-success mt-3 px-4 fw-semibold rounded-pill">
                <i class="bi bi-save me-1"></i> Lưu ghi chú
            </button>
        </form>
    </div>

    {{-- Lịch sử ghi chú --}}
    @if($cv->notes->count())
        <div class="mb-5">
            <h4 class="mb-4 fw-semibold text-primary ps-0" style="font-size: 1.5rem;">
                Lịch sử ghi chú
            </h4>
            <div class="d-flex flex-column gap-3">
                @foreach($cv->notes->sortByDesc('created_at') as $note)
                    <div class="p-3 rounded-4" style="line-height: 1.5; color: #444; background-color:#fcfcfc;">
                        <div class="fs-5">{{ $note->note }}</div>
                        <small class="text-muted fst-italic mt-2 d-block">
                            {{ $note->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4 py-2 fw-semibold">
        &larr; Quay lại
    </a>

</div>
@endsection
