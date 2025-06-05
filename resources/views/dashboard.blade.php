@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight text-center md:text-left">
            {{ __('Hệ thống quản lý tuyển dụng') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="text-center mb-4 text-primary fw-bold">📊 Thống kê ứng viên theo giai đoạn</h2>

                {{-- <form method="GET" action="{{ route('candidates.index') }}" class="row g-3 justify-content-center mb-4">
                <div class="col-md-4">
                    <label for="month" class="form-label">📅 Chọn tháng</label>
                    <input type="month" id="month" name="month" class="form-control" value="{{ request('month') }}">
                </div>
                <div class="col-md-4">
                    <label for="filter_field" class="form-label">🔍 Lọc theo giai đoạn</label>
                    <select name="filter_field" id="filter_field" class="form-select">
                        <option value="created_at" {{ request('filter_field') == 'created_at' ? 'selected' : '' }}>Ứng tuyển (Apply)</option>
                        <option value="qualify_date" {{ request('filter_field') == 'qualify_date' ? 'selected' : '' }}>Đạt yêu cầu</option>
                        <option value="interview1_date" {{ request('filter_field') == 'interview1_date' ? 'selected' : '' }}>Phỏng vấn 1</option>
                        <option value="interview2_date" {{ request('filter_field') == 'interview2_date' ? 'selected' : '' }}>Phỏng vấn 2</option>
                        <option value="offer_date" {{ request('filter_field') == 'offer_date' ? 'selected' : '' }}>Offer</option>
                        <option value="hand_date" {{ request('filter_field') == 'hand_date' ? 'selected' : '' }}>Nhận việc</option>
                    </select>
                </div>
                <div class="col-md-2 align-self-end">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel-fill me-1"></i> Lọc</button>
                </div>
            </form> --}}

                <div class="mt-4">
                    <h5 class="text-center text-secondary mb-3">📈 Biểu đồ ứng viên theo tháng</h5>
                    <canvas id="candidateChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);

        const ctx = document.getElementById('candidateChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                        label: 'Apply',
                        data: chartData.apply,
                        borderColor: '#0d6efd',
                        backgroundColor: '#0d6efd33',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Qualify',
                        data: chartData.qualify,
                        borderColor: '#198754',
                        backgroundColor: '#19875433',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Phỏng Vấn 1',
                        data: chartData.interview1,
                        borderColor: '#e83e8c',
                        backgroundColor: '#ffc10733',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Phỏng Vấn 2',
                        data: chartData.interview2,
                        borderColor: '#fd7e14',
                        backgroundColor: '#fd7e1433',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Offer',
                        data: chartData.offer,
                        borderColor: '#20c997',
                        backgroundColor: '#20c99733',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Onboard',
                        data: chartData.hand,
                        borderColor: '#dc3545',
                        backgroundColor: '#dc354533',
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 13
                            }
                        }
                    },
                    title: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 12
                            }
                        },
                        title: {
                            display: true,
                            text: 'Số lượng',
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>



    <div class="py-12 bg-gray-50 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">


            {{-- Hàng 0: Status --}}
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 text-center">📊 Status</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                    <!-- Tổng số CV -->
                    <div
                        class="p-6 rounded-2xl bg-indigo-100 shadow-lg transition-all duration-300 transform hover:scale-105 hover:bg-gradient-to-br from-indigo-200 to-white hover:ring-4 hover:ring-indigo-300 hover:shadow-indigo-300/50 animate-pulse group">
                        <div class="flex justify-center items-center mb-2">
                            <!-- Icon CV -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 text-indigo-700 group-hover:text-indigo-900 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6m-3 0v4m4-18H7a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2V6l-4-4z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-extrabold text-indigo-700 group-hover:text-indigo-900">
                            {{ $stats['total_cvs'] ?? 0 }}</p>
                        <p
                            class="mt-2 text-sm font-semibold text-indigo-600 group-hover:text-indigo-800 uppercase tracking-wider">
                            Tổng số CV</p>
                    </div>

                    <!-- Tổng số công việc -->
                    <div
                        class="p-6 rounded-2xl bg-blue-100 shadow-lg transition-all duration-300 transform hover:scale-105 hover:bg-gradient-to-br from-blue-200 to-white hover:ring-4 hover:ring-blue-300 hover:shadow-blue-300/50 animate-pulse group">
                        <div class="flex justify-center items-center mb-2">
                            <!-- Icon Jobs -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 text-blue-700 group-hover:text-blue-900 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7h18M3 12h18m-6 5H9" />
                            </svg>
                        </div>
                        <p class="text-3xl font-extrabold text-blue-700 group-hover:text-blue-900">
                            {{ $stats['total_jobs'] ?? 0 }}</p>
                        <p
                            class="mt-2 text-sm font-semibold text-blue-600 group-hover:text-blue-800 uppercase tracking-wider">
                            Tổng số công việc</p>
                    </div>

                    <!-- Tỷ lệ công việc mở -->
                    <div
                        class="p-6 rounded-2xl bg-green-100 shadow-lg transition-all duration-300 transform hover:scale-105 hover:bg-gradient-to-br from-green-200 to-white hover:ring-4 hover:ring-green-300 hover:shadow-green-300/50 animate-pulse group">
                        <div class="flex justify-center items-center mb-2">
                            <!-- Icon Percentage -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 text-green-700 group-hover:text-green-900 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a4 4 0 00-8 0v2m4 12a4 4 0 004-4v-5H9v5a4 4 0 004 4z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-extrabold text-green-700 group-hover:text-green-900">
                            {{ number_format($percentClosed, 2) }}%</p>
                        <p
                            class="mt-2 text-sm font-semibold text-green-600 group-hover:text-green-800 uppercase tracking-wider">
                            Tỷ lệ công việc đã đóng </p>
                    </div>
                </div>

            </div>

            {{-- Các block nút chức năng khác --}}
            <a href="{{ url('/cv') }}"
                class="block bg-indigo-600 hover:bg-indigo-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-3xl font-bold mb-2">📄 List CV</h3>
                <p class="text-white/90 text-lg">Xem và quản lý các hồ sơ ứng viên đã gửi.</p>
            </a>

            <a href="{{ url('/jobs') }}"
                class="block bg-blue-600 hover:bg-blue-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-3xl font-bold mb-2">📝 List Job</h3>
                <p class="text-white/90 text-lg">Theo dõi các vị trí đang tuyển dụng.</p>
            </a>

            <a href="{{ url('/apply') }}"
                class="block bg-green-600 hover:bg-green-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-3xl font-bold mb-2">📬 Add CV</h3>
                <p class="text-white/90 text-lg">Ứng viên có thể gửi hồ sơ ứng tuyển tại đây.</p>
            </a>

            <a href="{{ url('/pool') }}"
                class="block bg-yellow-500 hover:bg-yellow-600 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-3xl font-bold mb-2">📁 Pool</h3>
                <p class="text-white/90 text-lg">Quản lý danh sách ứng viên tiềm năng.</p>
            </a>

            {{-- Nút Thống kê cũng làm block như trên --}}
            <a href="{{ route('jobs.statistics') }}"
                class="block bg-indigo-600 hover:bg-indigo-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-3xl font-bold mb-2">➕ Thống kê</h3>
                <p class="text-white/90 text-lg">Xem thống kê chi tiết ứng viên và công việc.</p>
            </a>

        </div>
    </div>
@endsection
