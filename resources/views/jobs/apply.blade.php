@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Ứng tuyển công việc: {{ $job->title }}</h2>

    <form action="{{  route('jobs.submitApplication', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="full_name" class="form-label">Họ tên</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="birth_year" class="form-label">Năm sinh</label>
            <input type="number" name="birth_year" class="form-control" required min="1900" max="2100">

        </div>

        <div class="mb-3">
            <label for="last_company" class="form-label">Công ty gần nhất</label>
            <input type="text" name="last_company" class="form-control">
        </div>

        <div class="mb-3">
            <label for="last_position" class="form-label">Chức danh gần nhất</label>
            <input type="text" name="last_position" class="form-control">
        </div>

        <div class="mb-3">
            <label for="cv" class="form-label">Tải CV</label>
            <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx" required>
        </div>

        <button type="submit" class="btn btn-primary">Nộp đơn</button>
    </form>
</div>
@endsection
