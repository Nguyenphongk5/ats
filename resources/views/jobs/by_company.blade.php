@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h3 class="text-3xl font-bold mb-8 text-gray-900">Công ty: {{ $company->name }}</h3>
        <br>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Job đang mở --}}
            <a href="{{ route('jobs.open', ['company' => $company->id]) }}"
               class="block bg-green-50 border border-green-400 rounded-lg p-8 shadow hover:shadow-lg transition duration-300">
                <h4 class="text-2xl font-semibold mb-3 text-green-700 flex items-center gap-2">
                    🟢 Công việc đang mở
                </h4>
                <p class="text-green-800 font-medium">Xem danh sách công việc đang mở</p>
            </a>
  <br>
            {{-- Job đã đóng --}}
            <a href="{{ route('jobs.closed', ['company' => $company->id]) }}"
               class="block bg-red-50 border border-red-400 rounded-lg p-8 shadow hover:shadow-lg transition duration-300">
                <h4 class="text-2xl font-semibold mb-3 text-red-700 flex items-center gap-2">
                    🔴 Công việc đã đóng
                </h4>
                <p class="text-red-800 font-medium">Xem danh sách công việc đã đóng</p>
            </a>

        </div>
    </div>
</div>
@endsection
