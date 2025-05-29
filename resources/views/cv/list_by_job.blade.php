@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="text-center mb-4">Danh sách CV ứng tuyển cho công việc</h1>

            @if($cvs->isEmpty())
                <div class="alert alert-info text-center">
                    Chưa có CV nào cho công việc này.
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($cvs as $cv)
                        <div class="col">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">{{ $cv->full_name }}</h5>
                                    <p class="mb-1"><strong>Năm sinh:</strong> {{ $cv->birth_year }}</p>
                                    <p class="mb-1"><strong>Chức danh:</strong> {{ $cv->last_position }}</p>
                                    <p class="mb-1"><strong>Công ty gần nhất:</strong> {{ $cv->last_company }}</p>
                                    <p class="mb-2 text-muted"><strong>Ngày nộp:</strong> {{ $cv->created_at->format('d/m/Y H:i') }}</p>
                                    <a href="{{ route('cv.view', $cv->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-4 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</div>
@endsection
