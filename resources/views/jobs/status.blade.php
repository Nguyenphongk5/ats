@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">
            Danh sách công việc {{ $status == 'open' ? 'đang mở' : 'đã đóng' }} - {{ $company->name }}
        </h2>

        <script>
            function toggle(id) {
                const el = document.getElementById(id);
                el.style.display = (el.style.display === 'none') ? 'block' : 'none';
            }
        </script>

        {{-- Vị trí Quản lý --}}
        <div class="mb-6">
            <button onclick="toggle('managerJobs')"
                    class="text-left w-full bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold px-4 py-2 rounded mb-3">
                ▶ Jobs Quản lý
            </button>

            <div id="managerJobs" style="display: none;">
               @forelse ($managerJobs as $job)
<div class="flex items-center justify-between p-4 border rounded mb-3 bg-white hover:bg-blue-50 transition">
    <div class="flex-1">
        <a href="{{ route('jobs.show', $job->id) }}" class="block">
            <h4 class="text-lg font-medium">{{ $job->title }}</h4>
            <p class="text-sm text-gray-600">{{ Str::limit($job->description, 100) }}</p>
        </a>
    </div>
    <a href="{{ route('jobs.edit', $job->id) }}"
       class="ml-4 text-sm text-blue-600 hover:underline font-semibold whitespace-nowrap">
       Edit
    </a>
</div>
@empty
    <p class="text-gray-500">Không có công việc quản lý nào.</p>
@endforelse

            </div>
        </div>

        {{-- Vị trí Chuyên viên --}}
        <div>
            <button onclick="toggle('specialistJobs')"
                    class="text-left w-full bg-green-100 hover:bg-green-200 text-green-800 font-semibold px-4 py-2 rounded mb-3">
                ▶ Jobs Chuyên viên
            </button>

            <div id="specialistJobs" style="display: none;">
            @forelse ($specialistJobs as $job)
<div class="flex items-center justify-between p-4 border rounded mb-3 bg-white hover:bg-blue-50 transition">
    <div class="flex-1">
        <a href="{{ route('jobs.show', $job->id) }}" class="block">
            <h4 class="text-lg font-medium">{{ $job->title }}</h4>
            <p class="text-sm text-gray-600">{{ Str::limit($job->description, 100) }}</p>
        </a>
    </div>
    <a href="{{ route('jobs.edit', $job->id) }}"
       class="ml-4 text-sm text-green-600 hover:underline font-semibold whitespace-nowrap">
       Edit
    </a>
</div>
@empty
    <p class="text-gray-500">Không có công việc chuyên viên nào.</p>
@endforelse

            </div>
        </div>
    </div>
</div>
@endsection
