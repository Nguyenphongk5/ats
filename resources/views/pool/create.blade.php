@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-700">Thêm mới CxO</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pool.store') }}" method="POST">
        @csrf
        <label for="position" class="block mb-2 font-semibold text-gray-700">Chức vụ (Position)</label>
        <input
            type="text"
            name="position"
            id="position"
            value="{{ old('position') }}"
            required
            class="w-full px-3 py-2 border rounded mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            placeholder="Nhập tên chức vụ CxO"
        >

        <button
            type="submit"
            class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition"
        >
            Thêm mới
        </button>
    </form>

    <a href="{{ route('pool.index') }}" class="block mt-4 text-center text-indigo-600 hover:underline">
        ← Quay lại danh sách Pool
    </a>
</div>
@endsection
