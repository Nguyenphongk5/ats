@extends('layouts.app')

@section('content')
<div class="container py-5">
 <h2 style="color:#2c3e50; font-weight:700; margin-bottom:20px; border-bottom: 2px solid #3498db; padding-bottom:8px;">
    Chi tiết CV của {{ $cv->full_name ?? 'Ứng viên' }}
</h2>

<div style="max-width: 480px; background: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #34495e;">
    <p style="margin-bottom: 12px; font-size: 16px;"><strong>Họ tên:</strong> <span style="color: #2c3e50;">{{ $cv->full_name ?? 'Không có' }}</span></p>
    <p style="margin-bottom: 12px; font-size: 16px;"><strong>Năm sinh:</strong> <span style="color: #2c3e50;">{{ $cv->birth_year ?? 'Không có' }}</span></p>
    <p style="margin-bottom: 12px; font-size: 16px;"><strong>Công ty gần nhất:</strong> <span style="color: #2c3e50;">{{ $cv->last_company ?? 'Không có' }}</span></p>
    <p style="margin-bottom: 0; font-size: 16px;"><strong>Chức danh:</strong> <span style="color: #2c3e50;">{{ $cv->last_position ?? 'Không có' }}</span></p>
</div>

    @if(\Illuminate\Support\Str::endsWith($cv->file_path, '.pdf'))
        <iframe src="{{ asset('storage/' . $cv->file_path) }}" width="100%" height="600px"></iframe>
    @else
        <p>
            File CV: <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank">Tải xuống / Mở file</a>
        </p>
    @endif

    {{-- Form ghi chú --}}
<div class="mt-5 pt-4 border-top">
    <h5 class="mb-3">Thêm ghi chú mới</h5>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cv.saveNote', $cv->id) }}" method="POST">
        @csrf
        <textarea name="note" class="form-control" rows="4" placeholder="Nhập ghi chú tại đây...">{{ old('note') }}</textarea>
        @error('note')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <button type="submit" class="btn btn-success mt-2">
            <i class="bi bi-save"></i> Lưu ghi chú
        </button>
    </form>
</div>

{{-- Lịch sử ghi chú --}}
@if($cv->notes->count())
<div class="mt-5">
    <h5 class="mb-3" style="border-bottom: 2px solid #3498db; padding-bottom: 6px; font-weight: 600; color: #2c3e50;">
        Lịch sử ghi chú
    </h5>
    <ul class="list-group shadow-sm rounded">
        @foreach($cv->notes->sortByDesc('created_at') as $note)
            <li class="list-group-item d-flex flex-column">
                <div style="font-size: 1rem; color: #34495e; line-height: 1.4;">
                    {{ $note->note }}
                </div>
                <small class="text-muted mt-2" style="font-style: italic;">
                    {{ $note->created_at->format('d/m/Y H:i') }}
                </small>
            </li>
        @endforeach
        @if($cv->notes->isEmpty())
            <li class="list-group-item text-center text-muted fst-italic">
                Chưa có ghi chú nào.
            </li>
        @endif
    </ul>
</div>

@endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
