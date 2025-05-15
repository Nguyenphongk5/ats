@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Danh sách công việc</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Tên công việc</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Nộp CV</th>
                    <th scope="col">CV đã nộp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->name }}</td>
                        <td>{{ $job->description }}</td>
                        <td>Từ {{ $job->open_date }} đến {{ $job->close_date }}</td>
                        <td>
                            <form action="{{ route('jobs.uploadCv', $job->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="file" name="cv" class="form-control" required>
                                </div>
                                <div class="d-flex gap-2">
                                    <button onclick="return confirm('Bạn đã nộp CV thành công')" type="submit" class="btn btn-primary">Tải CV lên</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <h6>CV đã nộp:</h6>
                            <ul class="list-group">
                                @foreach($job->cvs()->where('user_id', auth()->id())->get() as $cv)
                                    <li class="list-group-item">
                                        <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank">CV #{{ $cv->id }}</a> ({{ $cv->created_at->format('d/m/Y H:i') }})
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
