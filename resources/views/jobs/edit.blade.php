@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Chỉnh sửa công việc: {{ $job->title }}</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Tiêu đề</label>
            <input type="text" id="title" name="title" value="{{ old('title', $job->title) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Mô tả</label>
            <textarea id="description" name="description" rows="5"
                      class="w-full border rounded px-3 py-2" required>{{ old('description', $job->description) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Lưu thay đổi
        </button>
    </form>
</div>
@endsection
