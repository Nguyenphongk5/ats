@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full shadow-lg mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Khám phá cơ hội việc làm
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Chọn công ty bạn quan tâm và khám phá những cơ hội việc làm tuyệt vời đang chờ đón bạn
                </p>
            </div>

            <!-- Action Bar -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 mb-8">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                        <h3 class="text-2xl font-bold text-gray-900">Danh sách công ty</h3>
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                            {{ $companies->count() }} công ty
                        </span>
                    </div>

                    <a href="{{ route('jobs.create') }}"
                       class="group relative inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <div class="absolute inset-0 bg-white/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Thêm việc làm mới</span>
                    </a>
                </div>
            </div>

            <!-- Companies Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($companies as $company)
                    <a href="{{ url('/jobs/company/' . $company->id) }}"
                       class="group relative block bg-white hover:bg-gradient-to-br hover:from-blue-50 hover:to-purple-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">

                        <!-- Company Icon -->
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-100 to-purple-100 group-hover:from-blue-200 group-hover:to-purple-200 rounded-full mb-6 transition-all duration-300">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>

                        <!-- Company Info -->
                        <div class="text-center">
                            <h4 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 mb-3 transition-colors duration-200">
                                {{ $company->name }}
                            </h4>

                            <div class="flex items-center justify-center gap-2 mb-4">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"></path>
                                </svg>
                                <span class="text-gray-600 font-medium">
                                    {{ $company->jobs_count }} {{ $company->jobs_count === 1 ? 'việc làm' : 'việc làm' }}
                                </span>
                            </div>

                            <!-- Job Count Badge -->
                            <div class="inline-flex items-center gap-1 bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 text-sm font-semibold px-4 py-2 rounded-full">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span>Đang tuyển dụng</span>
                            </div>
                        </div>

                        <!-- Hover Effect Arrow -->
                        <div class="absolute top-1/2 right-6 transform -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>

                        <!-- Gradient Border on Hover -->
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                        <div class="absolute inset-0.5 bg-white rounded-2xl -z-10"></div>
                    </a>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($companies->isEmpty())
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Chưa có công ty nào</h3>
                    <p class="text-gray-600 mb-8">Hiện tại chưa có công ty nào trong hệ thống. Hãy thêm công ty đầu tiên!</p>
                    <a href="{{ route('companies.create') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Thêm công ty mới</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .bg-clip-text {
        -webkit-background-clip: text;
        background-clip: text;
    }
</style>
@endpush
@endsection
