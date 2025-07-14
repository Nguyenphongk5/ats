@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-indigo-600/10"></div>
        <div class="relative max-w-6xl mx-auto px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                    Pool Ứng Viên
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Quản lý và tổ chức ứng viên tiềm năng một cách hiệu quả và chuyên nghiệp
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-6 lg:px-8 pb-16">
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- CxO Section -->
            <div class="group">
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 p-8 hover:shadow-2xl transition-all duration-500 hover:scale-[1.02] h-full">
                    <div class="flex items-center mb-8">
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-1">CxO Leadership</h2>
                            <p class="text-gray-600">Lãnh đạo cấp cao và điều hành</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-8">
                        @forelse ($cxos as $cxo)
                            <a href="{{ route('pool.show', $cxo->id) }}"
                               class="group/item flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 hover:shadow-md border border-blue-100/50">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center mr-3 shadow-sm">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($cxo->position, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 group-hover/item:text-blue-600 transition-colors">
                                            {{ $cxo->position }}
                                        </h3>
                                        <p class="text-sm text-gray-500">Executive Level</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover/item:text-blue-500 group-hover/item:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @empty
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 mb-4">Chưa có ứng viên CxO nào</p>
                            </div>
                        @endforelse
                    </div>

                    <a href="{{ route('pool.create') }}"
                       class="group/btn w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02] font-semibold">
                        <svg class="w-5 h-5 mr-2 group-hover/btn:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Thêm mới CxO
                    </a>
                </div>
            </div>

            <!-- Function Section -->
            <div class="group">
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 p-8 hover:shadow-2xl transition-all duration-500 hover:scale-[1.02] h-full">
                    <div class="flex items-center mb-8">
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-emerald-500 to-green-600 rounded-2xl shadow-lg mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-1">Function Teams</h2>
                            <p class="text-gray-600">Chuyên môn và kỹ năng chức năng</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-8">
                        @forelse ($functions as $function)
                            <a href="{{ route('pool.function.show', $function->id) }}"
                               class="group/item flex items-center justify-between p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl hover:from-emerald-100 hover:to-green-100 transition-all duration-300 hover:shadow-md border border-emerald-100/50">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-400 to-green-500 rounded-full flex items-center justify-center mr-3 shadow-sm">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($function->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 group-hover/item:text-emerald-600 transition-colors">
                                            {{ $function->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500">Functional Role</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover/item:text-emerald-500 group-hover/item:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @empty
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 mb-4">Chưa có function nào</p>
                            </div>
                        @endforelse
                    </div>

                    <a href="{{ route('pool.function.create') }}"
                       class="group/btn w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-emerald-600 to-green-600 text-white rounded-xl hover:from-emerald-700 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02] font-semibold">
                        <svg class="w-5 h-5 mr-2 group-hover/btn:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Thêm mới Function
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Tổng CxO</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $cxos->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Tổng Function</p>
                        <p class="text-3xl font-bold text-emerald-600">{{ $functions->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Tổng Ứng Viên</p>
                        <p class="text-3xl font-bold text-purple-600">{{ $cxos->count() + $functions->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .group:hover .float {
        animation: float 3s ease-in-out infinite;
    }

    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
</style>
@endsection
