@extends('layouts.app')

@section('content')
<div class="container py-5">
<h1 class="mb-4 fw-bold display-6">{{ $job->name }}</h1>


    <p><strong>Thời gian ứng tuyển:</strong> {{ $job->open_date }} - {{ $job->close_date }}</p>
<div class="mb-4">
    <h4>Mô tả công việc:</h4>
    <p>{!! nl2br(e($job->description)) !!}</p>
</div>


    <form action="{{ route('jobs.uploadCv', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="cv" class="form-label">Tải CV của bạn lên:</label>
            <input type="file" name="cv" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn đã nộp CV thành công')">Nộp CV</button>
    </form>

    {{-- <div class="mt-4">
        <h5>CV bạn đã nộp:</h5>
        <ul class="list-group">
            @forelse ($job->cvs as $cv)
                <li class="list-group-item">
                    <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank">CV #{{ $cv->id }}</a>
                    ({{ $cv->created_at->format('d/m/Y H:i') }})
                </li>
            @empty
                <li class="list-group-item text-muted">Bạn chưa nộp CV cho công việc này.</li>
            @endforelse
        </ul>
    </div> --}}
</div>
@endsection
