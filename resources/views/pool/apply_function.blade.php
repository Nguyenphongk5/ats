@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-700">
        Nộp CV vào Function: {{ $function->name }}
    </h2>

    <form action="{{ route('pool.function.submit', $function->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Họ tên</label>
            <input name="full_name" required class="w-full border rounded px-3 py-2" placeholder="Nguyễn Văn A">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Năm sinh</label>
            <input type="number" name="birth_year" required class="w-full border rounded px-3 py-2" placeholder="1990">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Công ty gần nhất</label>
            <input name="last_company" class="w-full border rounded px-3 py-2" placeholder="FPT, VNG...">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Chức danh</label>
            <input name="last_position" class="w-full border rounded px-3 py-2" placeholder="Trưởng phòng...">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Tải lên CV (PDF, DOC, DOCX)</label>
            <input type="file" name="cv" accept=".pdf,.doc,.docx" required class="w-full">
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Nộp CV
        </button>
    </form>
</div>
@endsection
