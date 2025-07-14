@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Chỉnh sửa công việc</h1>
            <p class="text-xl text-gray-600 font-medium">{{ $job->title }}</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mx-auto mt-4"></div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-8 p-6 bg-red-50 border border-red-200 rounded-2xl shadow-sm">
                        <div class="flex items-center mb-3">
                            <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-red-800">Vui lòng kiểm tra lại thông tin</h3>
                        </div>
                        <ul class="space-y-2">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span class="text-red-700">{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="group">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Tiêu đề công việc
                        </label>
                        <div class="relative">
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $job->title) }}"
                                   class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white/50 backdrop-blur-sm placeholder-gray-400 hover:border-gray-300 group-hover:shadow-md"
                                   placeholder="Nhập tiêu đề công việc..."
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="group">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Mô tả chi tiết
                        </label>
                        <div class="relative">
                            <textarea id="description"
                                      name="description"
                                      rows="6"
                                      class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-300 bg-white/50 backdrop-blur-sm placeholder-gray-400 hover:border-gray-300 group-hover:shadow-md resize-none"
                                      placeholder="Mô tả chi tiết về công việc, yêu cầu, điều kiện..."
                                      required>{{ old('description', $job->description) }}</textarea>
                            <div class="absolute top-4 right-4">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-4 px-8 rounded-2xl hover:from-blue-700 hover:to-purple-700 focus:ring-4 focus:ring-blue-200 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Lưu thay đổi</span>
                        </button>

                        <a href="{{ route('jobs.show', $job->id) }}"
                           class="flex-1 bg-gray-100 text-gray-700 font-semibold py-4 px-8 rounded-2xl hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Hủy bỏ</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-8 bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center space-x-3 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm">
                    <span class="font-semibold">Lưu ý:</span> Vui lòng kiểm tra kỹ thông tin trước khi lưu. Thay đổi sẽ được áp dụng ngay lập tức.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom animations */
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

    .group:hover input,
    .group:hover textarea {
        transform: translateY(-1px);
    }

    /* Gradient text animation */
    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Subtle floating animation */
    .backdrop-blur-sm {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Focus states */
    input:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Smooth transitions */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection
