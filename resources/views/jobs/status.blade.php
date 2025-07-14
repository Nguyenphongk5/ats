@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-12">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H8a2 2 0 00-2-2V6m8 0H8m0 0v.01M8 6v.01m8-.01V6m0 .01V6"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 via-blue-700 to-purple-600 bg-clip-text text-transparent mb-4">
                Danh sách công việc {{ $status == 'open' ? 'đang mở' : 'đã đóng' }}
            </h1>
            <div class="inline-flex items-center px-6 py-3 bg-white rounded-full shadow-lg border border-gray-200">
                <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mr-3"></div>
                <span class="text-gray-700 font-medium">{{ $company->name }}</span>
            </div>
        </div>

        <!-- Enhanced Toggle Script -->
        <script>
            function toggle(id) {
                const el = document.getElementById(id);
                const button = document.querySelector(`button[onclick="toggle('${id}')"]`);
                const arrow = button.querySelector('.arrow');

                if (el.style.display === 'none' || el.style.display === '') {
                    el.style.display = 'block';
                    el.classList.add('animate-fadeIn');
                    arrow.style.transform = 'rotate(90deg)';
                } else {
                    el.style.display = 'none';
                    el.classList.remove('animate-fadeIn');
                    arrow.style.transform = 'rotate(0deg)';
                }
            }
        </script>

        <style>
            .animate-fadeIn {
                animation: fadeIn 0.3s ease-in-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .job-card {
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .job-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s ease;
            }

            .job-card:hover::before {
                left: 100%;
            }

            .job-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }

            .category-button {
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .category-button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                transition: left 0.5s ease;
            }

            .category-button:hover::before {
                left: 100%;
            }

            .arrow {
                transition: transform 0.3s ease;
            }
        </style>

        <!-- Manager Jobs Section -->
        <div class="mb-8">
            <button onclick="toggle('managerJobs')"
                    class="category-button text-left w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold px-8 py-6 rounded-2xl mb-6 shadow-lg transform hover:scale-[1.02] transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"></path>
                            </svg>
                        </div>
                       <div>
    <h3 class="text-2xl font-bold">
        {{ $isCmcCorp ? 'Vị trí Quản lý' : 'CXO' }}
    </h3>
    <p class="text-blue-100 text-sm">
        {{ count($managerJobs) }} công việc có sẵn
    </p>
</div>
                    </div>
                    <div class="arrow text-3xl">▶</div>
                </div>
            </button>

            <div id="managerJobs" style="display: none;" class="space-y-4">
                @forelse ($managerJobs as $job)
                <div class="job-card bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:border-blue-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <a href="{{ route('jobs.show', $job->id) }}" class="block group">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 mb-2">
                                            {{ $job->title }}
                                        </h4>
                                        <p class="text-gray-600 leading-relaxed">
                                            {{ Str::limit($job->description, 120) }}
                                        </p>
                                        <div class="flex items-center mt-3 space-x-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Quản lý
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                {{ $job->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="ml-6 flex-shrink-0">
                            <a href="{{ route('jobs.edit', $job->id) }}"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Chỉnh sửa
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H8a2 2 0 00-2-2V6m8 0H8m0 0v.01M8 6v.01m8-.01V6m0 .01V6"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">Không có công việc quản lý nào.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Specialist Jobs Section -->
        <div class="mb-8">
            <button onclick="toggle('specialistJobs')"
                    class="category-button text-left w-full bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold px-8 py-6 rounded-2xl mb-6 shadow-lg transform hover:scale-[1.02] transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                      <div>
    <h3 class="text-2xl font-bold">
        {{ $isCmcCorp ? 'Vị trí Chuyên viên' : 'Trưởng nhóm' }}
    </h3>
    <p class="text-emerald-100 text-sm">
        {{ count($specialistJobs) }} công việc có sẵn
    </p>
</div>
                    </div>
                    <div class="arrow text-3xl">▶</div>
                </div>
            </button>

            <div id="specialistJobs" style="display: none;" class="space-y-4">
                @forelse ($specialistJobs as $job)
                <div class="job-card bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:border-emerald-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <a href="{{ route('jobs.show', $job->id) }}" class="block group">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300 mb-2">
                                            {{ $job->title }}
                                        </h4>
                                        <p class="text-gray-600 leading-relaxed">
                                            {{ Str::limit($job->description, 120) }}
                                        </p>
                                        <div class="flex items-center mt-3 space-x-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                Chuyên viên
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                {{ $job->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="ml-6 flex-shrink-0">
                            <a href="{{ route('jobs.edit', $job->id) }}"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Chỉnh sửa
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">Không có công việc chuyên viên nào.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
