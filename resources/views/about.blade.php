@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Banner with Animated Background -->
    <div class="relative bg-gradient-to-br from-indigo-900 via-blue-800 to-purple-900 text-white py-32 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-blue-300/20 rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-purple-300/10 rounded-full animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-28 h-28 bg-indigo-300/15 rounded-full animate-bounce"></div>
        </div>

        <!-- Geometric Patterns -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon points="0,0 100,0 80,100 0,100" fill="url(#grad1)" />
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:rgba(255,255,255,0.1);stop-opacity:1" />
                        <stop offset="100%" style="stop-color:rgba(255,255,255,0.05);stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 text-center">
            <!-- Company Logo/Icon -->
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full mb-8 animate-pulse">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                </svg>
            </div>

            <h1 class="text-5xl md:text-7xl font-black mb-6 bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent leading-tight">
                Tập đoàn Công nghệ CMC
            </h1>
            <p class="text-xl md:text-3xl font-light mb-8 text-blue-100 max-w-4xl mx-auto leading-relaxed">
                Kiến tạo tương lai số - Vươn tầm thế giới
            </p>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-white mb-2">30+</div>
                    <div class="text-blue-100">Năm phát triển</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-white mb-2">4,000+</div>
                    <div class="text-blue-100">Nhân viên</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-white mb-2">1993</div>
                    <div class="text-blue-100">Thành lập</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gradient-to-b from-gray-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- About Section -->
            <section class="mb-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Giới thiệu
                        </div>
                        <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                            Về <span class="text-blue-600">CMC Corporation</span>
                        </h2>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Thành lập từ năm 1993, Tập đoàn Công nghệ CMC là một trong những tập đoàn công nghệ hàng đầu tại Việt Nam. Với hơn 30 năm xây dựng và phát triển, CMC hoạt động trong nhiều lĩnh vực then chốt như:
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm border border-gray-100">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="text-sm font-medium text-gray-700">Giải pháp phần mềm</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm border border-gray-100">
                                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                <span class="text-sm font-medium text-gray-700">Tích hợp hệ thống</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm border border-gray-100">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm font-medium text-gray-700">Viễn thông</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg shadow-sm border border-gray-100">
                                <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                <span class="text-sm font-medium text-gray-700">Chuyển đổi số</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl transform rotate-3"></div>
                        <div class="relative bg-white p-8 rounded-3xl shadow-xl">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Dẫn đầu công nghệ</h3>
                                <p class="text-gray-600">Hướng đến trở thành một trong những tập đoàn công nghệ số hàng đầu khu vực và thế giới.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mission & Vision Cards -->
            <section class="mb-20">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Mission Card -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100 rounded-3xl p-8 border border-blue-200 hover:shadow-2xl transition-all duration-500">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Sứ mệnh</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                <span class="font-semibold text-blue-600">Kết nối tri thức - Khơi nguồn sáng tạo - Lan tỏa thành công.</span>
                                <br><br>
                                CMC cam kết kiến tạo hệ sinh thái số toàn diện nhằm giúp doanh nghiệp, tổ chức và chính phủ tăng cường năng lực số hóa.
                            </p>
                        </div>
                    </div>

                    <!-- Vision Card -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-pink-100 rounded-3xl p-8 border border-purple-200 hover:shadow-2xl transition-all duration-500">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Tầm nhìn</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Trở thành tập đoàn công nghệ toàn cầu, dẫn đầu về giải pháp chuyển đổi số, cung cấp dịch vụ và sản phẩm sáng tạo, chất lượng, đáng tin cậy.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Core Values -->
            <section class="mb-20">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        Giá trị cốt lõi
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900">Những giá trị định hướng</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl hover:border-blue-300 transition-all duration-300">
                        <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Khách hàng là trung tâm</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Tất cả hoạt động đều nhằm mang lại giá trị tốt nhất cho khách hàng.</p>
                    </div>

                    <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl hover:border-purple-300 transition-all duration-300">
                        <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Đổi mới không ngừng</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Liên tục cải tiến để tạo ra các sản phẩm và dịch vụ tiên tiến.</p>
                    </div>

                    <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl hover:border-green-300 transition-all duration-300">
                        <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Chất lượng – Uy tín</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Cam kết chất lượng cao và thực hiện đúng lời hứa.</p>
                    </div>

                    <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl hover:border-orange-300 transition-all duration-300">
                        <div class="w-14 h-14 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Hợp tác và phát triển</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Đề cao sự đoàn kết, tôn trọng và hỗ trợ lẫn nhau trong công việc.</p>
                    </div>
                </div>
            </section>

            <!-- Timeline -->
            <section class="mb-20">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Lịch sử phát triển
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900">Hành trình 30 năm</h2>
                </div>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>

                    <div class="space-y-12">
                        <div class="flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                                    <div class="text-2xl font-bold text-blue-600 mb-2">1993</div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Khởi đầu</h3>
                                    <p class="text-gray-600">Thành lập Công ty TNHH HT&TM CMC.</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center relative z-10">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="w-1/2 pl-8"></div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/2 pr-8"></div>
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center relative z-10">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="w-1/2 pl-8">
                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                                    <div class="text-2xl font-bold text-purple-600 mb-2">2007</div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Chuyển đổi</h3>
                                    <p class="text-gray-600">Chuyển đổi thành Tập đoàn Công nghệ CMC.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                                    <div class="text-2xl font-bold text-green-600 mb-2">2018</div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Toàn cầu hóa</h3>
                                    <p class="text-gray-600">Thành lập khối CMC Global – Đẩy mạnh xuất khẩu phần mềm.</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center relative z-10">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="w-1/2 pl-8"></div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/2 pr-8"></div>
                            <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center relative z-10">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="w-1/2 pl-8">
                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                                    <div class="text-2xl font-bold text-orange-600 mb-2">2020</div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Điện toán đám mây</h3>
                                    <p class="text-gray-600">Ra mắt nền tảng hạ tầng điện toán đám mây CMC Cloud.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                                    <div class="text-2xl font-bold text-indigo-600 mb-2">2023</div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">CMC 4.0</h3>
                                    <p class="text-gray-600">Định vị chiến lược "CMC 4.0" – tập trung vào chuyển đổi số toàn diện.</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center relative z-10">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="w-1/2 pl-8"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Company Image -->
            <section class="text-center">
                <div class="relative max-w-5xl mx-auto">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl transform rotate-1"></div>
                    <div class="relative bg-white p-4 rounded-3xl shadow-2xl">
                        <img src="https://cmc.com.vn/Data/Sites/1/media/cmcholding/ve-cmc/tap-doan-cmc.jpg"
                             alt="Tập đoàn CMC" class="w-full rounded-2xl">
                        <div class="absolute bottom-8 left-8 right-8 bg-white/90 backdrop-blur-sm rounded-xl p-4">
                            <p class="text-gray-700 font-medium">Tập đoàn Công nghệ CMC - Khát vọng vươn xa</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>
@endsection
