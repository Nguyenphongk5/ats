@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

            <!-- Header với animation -->
            <div class="text-center mb-16 animate-fade-in">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>

                <h1 class="text-5xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent mb-4">
                    {{ $company->name }}
                </h1>

                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Khám phá cơ hội nghề nghiệp tuyệt vời đang chờ đón bạn
                </p>

                <!-- Decorative line -->
                <div class="flex items-center justify-center mt-8">
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-300 to-transparent w-32"></div>
                    <div class="mx-4 w-2 h-2 bg-blue-400 rounded-full"></div>
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-300 to-transparent w-32"></div>
                </div>
            </div>

            <!-- Job Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">

                <!-- Công việc đang mở -->
                <a href="{{ route('jobs.open', ['company' => $company->id]) }}"
                   class="group relative overflow-hidden bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-green-100 opacity-50"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-200 to-emerald-300 rounded-full -translate-y-16 translate-x-16 opacity-20"></div>

                    <div class="relative p-8">
                        <!-- Icon -->
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Đang tuyển dụng
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">
                            Công việc đang mở
                        </h3>

                        <p class="text-gray-600 text-base leading-relaxed mb-6">
                            Khám phá những cơ hội nghề nghiệp hấp dẫn đang chờ đón bạn. Gia nhập đội ngũ tài năng của chúng tôi ngay hôm nay!
                        </p>

                        <!-- Arrow -->
                        <div class="flex items-center text-green-600 font-semibold group-hover:translate-x-2 transition-transform duration-300">
                            <span class="mr-2">Xem ngay</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Hover effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                </a>

                <!-- Công việc đã đóng -->
                <a href="{{ route('jobs.closed', ['company' => $company->id]) }}"
                   class="group relative overflow-hidden bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-50 to-red-100 opacity-50"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-200 to-rose-300 rounded-full -translate-y-16 translate-x-16 opacity-20"></div>

                    <div class="relative p-8">
                        <!-- Icon -->
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-red-400 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    Đã kết thúc
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-red-600 transition-colors">
                            Công việc đã đóng
                        </h3>

                        <p class="text-gray-600 text-base leading-relaxed mb-6">
                            Xem lại những vị trí đã kết thúc tuyển dụng. Có thể bạn sẽ tìm thấy cảm hứng cho những cơ hội tương lai.
                        </p>

                        <!-- Arrow -->
                        <div class="flex items-center text-red-600 font-semibold group-hover:translate-x-2 transition-transform duration-300">
                            <span class="mr-2">Xem lịch sử</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Hover effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-rose-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                </a>
            </div>

            <!-- Additional Info Section -->
            <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <h4 class="text-2xl font-bold text-gray-900 mb-3">
                        Tại sao chọn chúng tôi?
                    </h4>

                    <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        Chúng tôi cam kết tạo ra môi trường làm việc tốt nhất cho mọi thành viên.
                        Hãy cùng chúng tôi xây dựng tương lai và phát triển sự nghiệp của bạn.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
