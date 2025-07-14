@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">
        🔍 Chi tiết Function: {{ $function->name }}
    </h2>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <div class="mb-4">
            <p class="text-gray-700 text-lg"><strong>Mô tả:</strong></p>
            <p class="text-gray-900 mt-1 whitespace-pre-line">
                {{ $function->description ?? 'Không có mô tả' }}
            </p>
        </div>

        <div class="mb-6">
            <p class="text-gray-700 text-lg"><strong>Trạng thái:</strong></p>
            <p class="mt-1 text-base font-semibold {{ $function->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                {{ $function->status === 'active' ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mt-6">
            <a href="{{ route('pool.function.apply', $function->id) }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow font-semibold transition">
               ➕ Add CV
            </a>

            <a href="{{ route('pool.function.cvs', $function->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow font-semibold transition">
               📄 Xem CV
            </a>

            <a href="{{ route('pool.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded shadow font-semibold transition">
               ← Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection
