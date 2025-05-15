@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Thêm công việc mới</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.storeJob') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên công việc</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="open_date" class="form-label">Ngày bắt đầu</label>
            <input type="date" name="open_date" class="form-control" value="{{ old('open_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="close_date" class="form-label">Ngày kết thúc</label>
            <input type="date" name="close_date" class="form-control" value="{{ old('close_date') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm công việc</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
