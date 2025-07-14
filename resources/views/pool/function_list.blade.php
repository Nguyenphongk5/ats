@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-green-700 text-center">
        📄 Danh sách CV theo Function: {{ $function->name }}
    </h2>

    @forelse ($cvs as $cv)
        <div class="bg-white shadow rounded p-4 mb-4">
            <p><strong>Họ tên:</strong> {{ $cv->full_name }}</p>
            <p><strong>Năm sinh:</strong> {{ $cv->birth_year }}</p>
            <p><strong>Công ty gần nhất:</strong> {{ $cv->last_company ?? 'Không có' }}</p>
            <p><strong>Chức danh:</strong> {{ $cv->last_position ?? 'Không có' }}</p>
            <a href="{{ asset('storage/' . $cv->file_path) }}" class="text-blue-600 underline" target="_blank">📥 Tải CV</a>
        </div>
    @empty
        <p class="text-center text-gray-600">Chưa có CV nào được nộp vào Function này.</p>
    @endforelse

    <div class="text-center mt-6">
        <a href="{{ route('pool.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Quay lại danh sách
        </a>
    </div>
</div>
@endsection
