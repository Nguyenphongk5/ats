@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 relative overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-purple-200 to-indigo-200 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-blue-200 to-cyan-200 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full opacity-10 animate-spin" style="animation-duration: 60s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Stunning Header -->
      <div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-4 shadow-lg transform hover:scale-105 transition-all duration-300">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
    </div>
    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
        Thống kê Job Offer
    </h1>
    <p class="text-base text-gray-600 font-light max-w-xl mx-auto">
        Theo dõi hiệu suất tuyển dụng
    </p>
    <div class="mt-4 flex justify-center">
        <div class="w-16 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full"></div>
    </div>
</div>

            <!-- Floating Action Buttons -->
            <div class="fixed top-24 right-8 flex flex-col space-y-4 z-20">
                <button onclick="window.print()"
                    class="group relative w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span class="absolute right-16 px-3 py-2 bg-black text-white text-sm rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                        In báo cáo
                    </span>
                </button>
                <button id="exportExcelBtn"
                    class="group relative w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="absolute right-16 px-3 py-2 bg-black text-white text-sm rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                        Xuất Excel
                    </span>
                </button>
            </div>

            <!-- Premium Filter Cards -->
       <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Time Filter Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Bộ lọc thời gian</h3>
        </div>
        <form method="GET" action="{{ route('jobs.statistics') }}">
            <div class="space-y-3">
                <div class="relative">
                    <label for="month" class="block text-sm font-medium text-gray-700 mb-1">Chọn tháng:</label>
                    <input type="month" id="month" name="month" value="{{ request('month') }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200 bg-white/50 backdrop-blur-sm" />
                </div>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white font-medium py-2 px-4 rounded-lg hover:from-blue-600 hover:to-cyan-600 transform hover:scale-105 transition-all duration-200 shadow-md">
                        Áp dụng
                    </button>
                    @if (request('month'))
                        <a href="{{ route('jobs.statistics') }}"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-all duration-200 transform hover:scale-105">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Type Filter Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Bộ lọc loại việc</h3>
        </div>
        <form method="GET" action="{{ route('jobs.statistics') }}">
            <div class="space-y-3">
                <div class="relative">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Loại công việc:</label>
                    <select name="type" id="type"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all duration-200 bg-white/50 backdrop-blur-sm">
                        <option value="">Tất cả</option>
                        <option value="manager" {{ request('type') == 'manager' ? 'selected' : '' }}>Quản lý</option>
                        <option value="specialist" {{ request('type') == 'specialist' ? 'selected' : '' }}>Chuyên viên</option>
                    </select>
                </div>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-medium py-2 px-4 rounded-lg hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-200 shadow-md">
                        Áp dụng
                    </button>
                    @if (request('type'))
                        <a href="{{ route('jobs.statistics') }}"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-all duration-200 transform hover:scale-105">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>


            <!-- Elegant Status Tabs -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Bảng điều khiển trạng thái</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('jobs.statistics', request()->except('status')) }}"
                        class="group relative px-8 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 {{ !request('status') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <span class="relative z-10">📊 Tất cả</span>
                        <span class="ml-2 px-2 py-1 bg-white/20 rounded-full text-sm">{{ $jobs->count() }}</span>
                    </a>
                    <a href="{{ route('jobs.statistics', array_merge(request()->except('status'), ['status' => 'on_time'])) }}"
                        class="group relative px-8 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 {{ request('status') === 'on_time' ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <span class="relative z-10">✅ Đúng hạn</span>
                        <span class="ml-2 px-2 py-1 bg-white/20 rounded-full text-sm">{{ $countOnTime }}</span>
                    </a>
                    <a href="{{ route('jobs.statistics', array_merge(request()->except('status'), ['status' => 'late'])) }}"
                        class="group relative px-8 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 {{ request('status') === 'late' ? 'bg-gradient-to-r from-red-500 to-pink-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <span class="relative z-10">⏱️ Chậm</span>
                        <span class="ml-2 px-2 py-1 bg-white/20 rounded-full text-sm">{{ $countLate }}</span>
                    </a>
                    <a href="{{ route('jobs.statistics', array_merge(request()->except('status'), ['status' => 'processing'])) }}"
                        class="group relative px-8 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 {{ request('status') === 'processing' ? 'bg-gradient-to-r from-yellow-500 to-orange-500 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <span class="relative z-10">🔄 Đang tiến hành</span>
                        <span class="ml-2 px-2 py-1 bg-white/20 rounded-full text-sm">{{ $countProcessing }}</span>
                    </a>
                </div>
            </div>

            <!-- Luxurious Data Table -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2z"></path>
                        </svg>
                        Bảng dữ liệu chi tiết
                    </h3>
                    <p class="text-purple-100 mt-2">Thông tin chi tiết về các job offer</p>
                </div>

                <div class="overflow-x-auto">
                    <table id="jobOfferTable" class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">#</span>
                                        STT
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">💼</span>
                                        Tên Job
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">🏷️</span>
                                        Loại
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">📅</span>
                                        Ngày mở
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">🎯</span>
                                        Ngày Offer
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 bg-teal-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">⏱️</span>
                                        Thời gian
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">🚀</span>
                                        Trạng thái
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($jobs as $index => $job)
                                @if ($job->cvs->whereNotNull('offer_date')->isNotEmpty())
                                    @foreach ($job->cvs->whereNotNull('offer_date') as $cvIndex => $cv)
                                        @php
                                            $offerDate = $cv->offer_date;
                                            $days = (int) $job->created_at->diffInDays($offerDate);
                                            $isManager = $job->type === 'manager';
                                            $threshold = $isManager ? 60 : 45;
                                            $status = $days > $threshold ? 'Chậm' : 'Đúng hạn';
                                            $statusColor = $days > $threshold ? 'from-red-500 to-pink-500' : 'from-green-500 to-emerald-500';
                                            $statusIcon = $days > $threshold ? '⏱️' : '✅';
                                        @endphp
                                        <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                                        {{ $index + 1 }}
                                                    </div>
                                                    @if($job->cvs->count() > 1)
                                                        <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">{{ $cvIndex + 1 }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300" title="{{ $job->title }}">
                                                    {{ Str::limit($job->title, 40) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r {{ $isManager ? 'from-blue-500 to-cyan-500' : 'from-green-500 to-emerald-500' }} text-white shadow-sm">
                                                    {{ $isManager ? '👔 Quản lý' : '🎯 Chuyên viên' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                {{ $job->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                {{ $offerDate->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                    {{ $days }} ngày
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r {{ $statusColor }} text-white shadow-sm">
                                                    {{ $statusIcon }} {{ $status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @php
                                        $today = now();
                                        $days = $job->created_at->diffInDays($today);
                                        $isManager = $job->type === 'manager';
                                        $threshold = $isManager ? 60 : 45;
                                        $isLate = $days > $threshold;
                                    @endphp
                                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                    {{ $index + 1 }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300" title="{{ $job->title }}">
                                                {{ Str::limit($job->title, 40) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r {{ $isManager ? 'from-blue-500 to-cyan-500' : 'from-green-500 to-emerald-500' }} text-white shadow-sm">
                                                {{ $isManager ? '👔 Quản lý' : '🎯 Chuyên viên' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                            {{ $job->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 italic">--</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 italic">--</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-yellow-500 to-orange-500 text-white shadow-sm">
                                                🔄 Đang tiến hành
                                            </span>
                                            @if ($isLate)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-red-500 to-pink-500 text-white shadow-sm ml-2">
                                                    Chậm
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Thư viện SheetJS để xuất Excel --}}
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById('exportExcelBtn').addEventListener('click', function() {
            const table = document.getElementById('jobOfferTable');
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Job Offer Statistics"
            });
            XLSX.writeFile(wb, 'thong_ke_job_offer_' + new Date().toISOString().split('T')[0] + '.xlsx');
        });
    </script>

    {{-- Style in trang --}}
    <style>
        @media print {
            body {
                background: white !important;
            }

            .min-h-screen {
                min-height: auto !important;
            }

            .bg-gray-50 {
                background: white !important;
            }

            .shadow-sm, .shadow-lg {
                box-shadow: none !important;
            }

            .border {
                border: 1px solid #000 !important;
            }

            .px-4, .px-6, .px-8 {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .py-8 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }

            #jobOfferTable {
                font-size: 10pt !important;
            }

            #jobOfferTable th,
            #jobOfferTable td {
                padding: 0.25rem !important;
            }

            .max-w-xs {
                max-width: none !important;
            }

            .truncate {
                white-space: normal !important;
                overflow: visible !important;
                text-overflow: clip !important;
            }
        }

        @media screen and (max-width: 768px) {
            .max-w-xs {
                max-width: 8rem;
            }
        }
    </style>
@endsection
