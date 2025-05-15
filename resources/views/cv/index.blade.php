@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Danh sách CV</h1>
        <div class="row">
            @foreach($cvsGrouped as $jobId => $groupedCvs)
                <div class="col-12 mb-4">
                    <h5 class="fw-bold fs-4">Job: {{ $groupedCvs->first()->job?->name ?? 'Không có công việc' }}</h5>
                </div>

                @foreach($groupedCvs as $cv)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">CV #{{ $cv->id }}</h5>
                                <p class="text-muted">Ngày nộp: {{ $cv->created_at->format('d/m/Y H:i') }}</p>
                                <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank" class="btn btn-primary">Xem
                                    CV</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
