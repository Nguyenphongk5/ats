@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4 text-green-700 text-center">Thông tin Function: {{ $function->name }}</h2>

    <div class="bg-white p-6 shadow rounded">
        <p><strong>Mô tả:</strong> {{ $function->description ?? 'Không có mô tả' }}</p>
        <p class="mt-2"><strong>Trạng thái:</strong>
            <span class="{{ $function->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                {{ $function->status === 'active' ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
            </span>
        </p>

        <div class="mt-4 space-x-3">
            <a href="{{ route('pool.function.apply', $function->id) }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Add CV</a>
            <a href="{{ route('pool.function.cvs', $function->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">📄 Xem CV</a>
        </div>
    </div>
</div>
@endsection
