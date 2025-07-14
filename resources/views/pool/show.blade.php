@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="max-w-6xl mx-auto px-4 py-12">
        {{-- Header Section --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6.5"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                Vị trí {{ $cxo->position }}
            </h1>
            <p class="text-xl text-gray-600">Quản lý và theo dõi các ứng viên</p>
        </div>

        {{-- Main Content Card --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            {{-- Header with gradient --}}
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2">
                            📋 Thông tin vị trí
                        </h2>
                        <p class="text-indigo-100">Chi tiết và trạng thái hiện tại</p>
                    </div>
                  
                </div>
            </div>

            {{-- Content Body --}}
            <div class="p-8">
                {{-- Description Section --}}
                <div class="mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Mô tả vị trí</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $cxo->description ?? 'Chưa có mô tả chi tiết cho vị trí này.' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Status Section --}}
                <div class="mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Trạng thái</h3>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $cxo->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <span class="w-2 h-2 rounded-full mr-2
                                        {{ $cxo->status === 'active' ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                    {{ $cxo->status === 'active' ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="border-t border-gray-200 pt-8">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        {{-- Add CV Button --}}
                        <a href="{{ route('pool.apply', $cxo->id) }}"
                           class="group relative inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg shadow-lg hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                           Add CV
                        </a>

                        {{-- View CV Button --}}
                        <a href="{{ route('pool.cvs', $cxo->id) }}"
                           class="group relative inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                         List CV
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Stats or Additional Info (Optional) --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6 text-center border border-gray-100">
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Ứng viên</h3>
                <p class="text-gray-600">Quản lý hồ sơ ứng viên</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center border border-gray-100">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Trạng thái</h3>
                <p class="text-gray-600">{{ $cxo->status === 'active' ? 'Đang tuyển dụng' : 'Tạm dừng' }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center border border-gray-100">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Vị trí</h3>
                <p class="text-gray-600">{{ $cxo->position }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
