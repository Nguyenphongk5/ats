@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">➕ Thêm Function mới</h2>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pool.function.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Tên Function:</label>
                    <input type="text" id="name" name="name"
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                           placeholder="Nhập tên function" required>
                </div>

                <div class="text-center">
                    <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                        💾 Lưu Function
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
