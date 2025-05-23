@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="mb-4 fw-bold text-primary pb-2" style="font-size: 2rem; border-bottom: none;">
        Chi tiết CV của {{ $cv->full_name ?? 'Ứng viên' }}
    </h2>

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
