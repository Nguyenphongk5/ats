@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Danh sách công việc</h1>
        <a href="{{ route('jobs.create') }}" class="btn btn-success mb-4">+ Thêm công việc mới</a>

        <div class="row">
            @foreach($jobs as $job)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="card-title fw-bold fs-4">
                                <a href="{{ route('jobs.show', $job->id) }}">{{ $job->name }}</a>
                            </h2>


                            {{-- <p class="card-text">{{ $job->description }}</p> --}}
                            <p class="text-muted">Từ {{ $job->open_date }} đến {{ $job->close_date }}</p>
                            <form action="{{ route('jobs.uploadCv', $job->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="mb-3">
                                    <input type="file" name="cv" class="form-control" required>
                                </div> --}}
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info">Xem chi tiết</a>

                            </form>
                            <form id="upload-form-{{ $job->id }}" action="{{ route('jobs.uploadCv', $job->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            {{-- @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                            @endif --}}
                            {{-- <div class="mt-3">
                                <h6>CV đã nộp:</h6>
                                <ul class="list-group">
                                    @foreach($job->cvs()->where('user_id', auth()->id())->get() as $cv)
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank">CV #{{ $cv->id }}</a>
                                            ({{ $cv->created_at->format('d/m/Y H:i') }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
