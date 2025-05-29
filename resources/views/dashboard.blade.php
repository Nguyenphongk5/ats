@extends('layouts.app')

@section('content')



    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight text-center md:text-left">
            {{ __('Hệ thống quản lý tuyển dụng') }}
        </h2>
    </x-slot>




    <div class="py-12 bg-gray-50 min-h-screen">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Hàng 0: Status --}}
        <div class="bg-white p-8 rounded-xl shadow-md">
            <h3 class="text-2xl font-bold mb-6 text-gray-800 text-center">📊 Status</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                <div class="p-6 bg-indigo-100 rounded-lg shadow-inner">
                    <p class="text-4xl font-extrabold text-indigo-700">{{ $stats['total_cvs'] ?? 0 }}</p>
                    <p class="mt-2 text-lg font-medium text-indigo-600">Tổng số CV</p>
                </div>
                <div class="p-6 bg-blue-100 rounded-lg shadow-inner">
                    <p class="text-4xl font-extrabold text-blue-700">{{ $stats['total_jobs'] ?? 0 }}</p>
                    <p class="mt-2 text-lg font-medium text-blue-600">Tổng số công việc</p>
                </div>
                <div class="p-6 bg-green-100 rounded-lg shadow-inner">
                    <p class="text-4xl font-extrabold text-green-700">{{ $stats['total_applicants'] ?? 0 }}</p>
                    <p class="mt-2 text-lg font-medium text-green-600">Tổng số ứng viên</p>
                </div>
            </div>
        </div>

        {{-- Các block nút chức năng khác --}}
        <a href="{{ url('/cv') }}" class="block bg-indigo-600 hover:bg-indigo-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <h3 class="text-3xl font-bold mb-2">📄 List CV</h3>
            <p class="text-white/90 text-lg">Xem và quản lý các hồ sơ ứng viên đã gửi.</p>
        </a>

        <a href="{{ url('/jobs') }}" class="block bg-blue-600 hover:bg-blue-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <h3 class="text-3xl font-bold mb-2">📝 List Job</h3>
            <p class="text-white/90 text-lg">Theo dõi các vị trí đang tuyển dụng.</p>
        </a>

        <a href="{{ url('/apply') }}" class="block bg-green-600 hover:bg-green-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <h3 class="text-3xl font-bold mb-2">📬 Add CV</h3>
            <p class="text-white/90 text-lg">Ứng viên có thể gửi hồ sơ ứng tuyển tại đây.</p>
        </a>

        <a href="{{ url('/pool') }}" class="block bg-yellow-500 hover:bg-yellow-600 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <h3 class="text-3xl font-bold mb-2">📁 Pool</h3>
            <p class="text-white/90 text-lg">Quản lý danh sách ứng viên tiềm năng.</p>
        </a>

        {{-- Nút Thống kê cũng làm block như trên --}}
        <a href="{{ route('candidates.index') }}" class="block bg-indigo-600 hover:bg-indigo-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <h3 class="text-3xl font-bold mb-2">➕ Thống kê</h3>
            <p class="text-white/90 text-lg">Xem thống kê chi tiết ứng viên và công việc.</p>
        </a>

    </div>
</div>

@endsection
