@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h2 class="text-xl font-bold mb-6 text-center text-indigo-700">
        🧑‍💼 Nộp CV vào Pool: {{ $cxo->position }}
    </h2>

    <form action="{{ route('pool.submit', $cxo->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="full_name" class="block font-medium">Họ và tên</label>
            <input type="text" name="full_name" id="full_name" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="birth_year" class="block font-medium">Năm sinh</label>
            <input type="number" name="birth_year" id="birth_year" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="last_company" class="block font-medium">Công ty gần nhất</label>
            <input type="text" name="last_company" id="last_company" class="w-full border p-2 rounded">
        </div>

        <div>
            <label for="last_position" class="block font-medium">Chức danh gần nhất</label>
            <input type="text" name="last_position" id="last_position" class="w-full border p-2 rounded">
        </div>

        <div>
            <label for="cv" class="block font-medium">Tải CV (PDF/DOC)</label>
            <input type="file" name="cv" id="cv" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            ✅ Nộp CV
        </button>
    </form>
</div>
@endsection
