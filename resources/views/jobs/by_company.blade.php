@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Tiêu đề công ty -->
        <div class="text-center">
            <h3 class="text-4xl font-extrabold text-gray-900 mb-2">
                🏢 {{ $company->name }}
            </h3>
            <p class="text-gray-600 text-lg">Chọn loại công việc bạn muốn xem</p>
        </div>

        <!-- Lựa chọn công việc -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Công việc đang mở -->
            <a href="{{ route('jobs.open', ['company' => $company->id]) }}"
               class="block bg-green-50 hover:bg-green-100 border border-green-300 rounded-2xl p-8 shadow transition-all duration-300 hover:shadow-lg">
                <h4 class="text-2xl font-bold text-green-700 flex items-center gap-2 mb-2">
                    🟢 Công việc đang mở
                </h4>
                <p class="text-green-800 text-base">Xem danh sách công việc hiện đang tuyển dụng</p>
            </a>

            <!-- Công việc đã đóng -->
            <a href="{{ route('jobs.closed', ['company' => $company->id]) }}"
               class="block bg-red-50 hover:bg-red-100 border border-red-300 rounded-2xl p-8 shadow transition-all duration-300 hover:shadow-lg">
                <h4 class="text-2xl font-bold text-red-700 flex items-center gap-2 mb-2">
                    🔴 Công việc đã đóng
                </h4>
                <p class="text-red-800 text-base">Xem danh sách công việc đã kết thúc</p>
            </a>
        </div>

    </div>
</div>
@endsection
