@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Nộp CV</h1>
                    <form action="{{ route('cv.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="cv" class="form-label">Chọn file CV</label>
                            <input type="file" name="cv" id="cv" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Tải CV lên</button>
                              {{-- <a href="{{ route('views.dashboard') }}" class="btn btn-primary">Quay lại</a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
