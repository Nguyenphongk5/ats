@extends('layouts.app')

@section('content')
<form action="{{ route('cv.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="job_id" value="{{ $job->id }}">

    <div class="mb-4">
        <label for="full_name">👤 Họ tên <span class="text-danger">*</span></label>
        <input type="text" name="full_name" class="form-control" required>
    </div>

    <div class="mb-4">
        <label for="birth_year">🎂 Năm sinh <span class="text-danger">*</span></label>
        <input type="number" name="birth_year" min="1900" max="2100" class="form-control" required>
    </div>

    <div class="mb-4">
        <label for="last_company">🏢 Công ty gần nhất</label>
        <input type="text" name="last_company" class="form-control">
    </div>

    <div class="mb-4">
        <label for="last_position">💼 Chức danh gần nhất</label>
        <input type="text" name="last_position" class="form-control">
    </div>

    <div class="mb-4">
        <label for="cv">📎 Tải lên CV <span class="text-danger">*</span></label>
        <input type="file" name="cv" accept=".pdf,.doc,.docx" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">🚀 Add CV</button>
</form>

@endsection
