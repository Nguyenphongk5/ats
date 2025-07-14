{{-- @extends('layouts.app')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-900 leading-tight text-center md:text-left">
        {{ __('Danh sách Function') }}
    </h2>
</x-slot>

<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-8">
            <h3 class="text-2xl font-bold mb-6 text-gray-800 text-center">🛠️ Function Ứng Viên</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Cột Quản lý -->
                <div class="bg-yellow-100 p-6 rounded-lg shadow">
                    <h4 class="text-xl font-semibold text-yellow-700 mb-4">👔 Quản lý</h4>
                    @foreach ($managers as $manager)
                        <div class="mb-2 px-4 py-2 bg-white rounded shadow-sm text-yellow-800 font-medium">
                            {{ $manager }}
                        </div>
                    @endforeach
                </div>

                <!-- Cột Nhân viên -->
                <div class="bg-teal-100 p-6 rounded-lg shadow">
                    <h4 class="text-xl font-semibold text-teal-700 mb-4">👷 Nhân viên</h4>
                    @foreach ($staffs as $staff)
                        <div class="mb-2 px-4 py-2 bg-white rounded shadow-sm text-teal-800 font-medium">
                            {{ $staff }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
