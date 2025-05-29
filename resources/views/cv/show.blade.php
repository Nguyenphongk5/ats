@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Chi tiết CV</h1>
                    <div class="mb-4">
                        <h5>CV #{{ $cv->id }}</h5>
                        <p class="text-muted">Ngày nộp: {{ $cv->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-4">
                        <h5>Thông tin Job</h5>
                        <p><strong>Tên Job:</strong> {{ $cv->job->name }}</p>
                        <p><strong>Mô tả:</strong> {{ $cv->job->description }}</p>
                        <p><strong>Thời gian:</strong> Từ {{ $cv->job->open_date }} đến {{ $cv->job->close_date }}</p>
                    </div>
                    <div class="text-center">
                        <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank" class="btn btn-primary">Xem CV</a>
                        <a href="{{ route('cv.index') }}" class="btn btn-primary">Quay lại danh sách</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
