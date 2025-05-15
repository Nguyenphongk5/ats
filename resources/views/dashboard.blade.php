@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hệ thống quản lý tuyển dụng') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-3xl font-bold mb-4 text-gray-900">🎯 Chào mừng bạn đến với hệ thống ATS</h3>
                <p class="text-gray-700 text-lg">
                    Quản lý tuyển dụng, theo dõi hồ sơ và giúp bạn tối ưu quy trình tuyển dụng.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="/cv" class="block bg-indigo-700 hover:bg-indigo-800 text-black p-6 rounded-xl shadow-lg transition duration-200">
                    <h4 class="text-xl font-bold mb-2">📄 Danh sách CV</h4>
                    <p class="text-base">Xem và quản lý các hồ sơ ứng viên đã gửi.</p>
                </a>
                <a href="/jobs" class="block bg-blue-700 hover:bg-blue-800 text-black p-6 rounded-xl shadow-lg transition duration-200">
                    <h4 class="text-xl font-bold mb-2">📝 Danh sách Job</h4>
                    <p class="text-base">Theo dõi các vị trí đang tuyển dụng.</p>
                </a>
                <a href="/apply" class="block bg-green-700 hover:bg-green-800 text-black p-6 rounded-xl shadow-lg transition duration-200">
                    <h4 class="text-xl font-bold mb-2">📬 Nộp CV</h4>
                    <p class="text-base">Ứng viên có thể gửi hồ sơ ứng tuyển tại đây.</p>
                </a>
            </div>

            {{-- <div class="mt-6 text-sm text-gray-600">
                Bạn đã đăng nhập với tài khoản: <strong>{{ Auth::user()->email }}</strong>
            </div> --}}



        </div>
    </div>
@endsection
