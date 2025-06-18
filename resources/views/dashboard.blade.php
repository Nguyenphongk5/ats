@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 pt-24 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto flex gap-8">
        {{-- Sidebar trái --}}
        <aside class="w-72 bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 transform hover:scale-[1.03] transition duration-500 ease-in-out">
            <h3 class="text-2xl font-extrabold text-gray-900 mb-6 flex items-center gap-3 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                <span class="text-purple-600">📚</span> Menu
            </h3>
            <nav class="space-y-3">
                @foreach ([
                    ['url' => '/', 'label' => '🏠 Dashboard'],
                    ['url' => '/cv', 'label' => '📄 List CV'],
                    ['url' => '/jobs', 'label' => '📝 List Job'],
                    ['url' => '/apply', 'label' => '📬 Add CV'],
                    ['url' => '/pool', 'label' => '📁 Pool'],
                    ['url' => route('jobs.statistics'), 'label' => '📊 Thống kê']
                ] as $item)
                    <a href="{{ url($item['url']) }}"
                       class="block px-5 py-3 rounded-xl text-gray-800 font-semibold bg-white hover:bg-gradient-to-r hover:from-purple-100 hover:via-indigo-100 hover:to-blue-100 hover:text-purple-700 transition duration-300 ease-in-out transform hover:translate-x-2 hover:shadow-md">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- Nội dung chính bên phải --}}
        <main class="flex-1">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-8 flex items-center gap-4 bg-white py-5 px-6 rounded-3xl shadow-lg animate-fade-in">
                <span class="text-indigo-600">📈</span> Biểu đồ & Thống kê
            </h2>

            {{-- Biểu đồ --}}
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10 transform transition duration-500 ease-in-out hover:shadow-3xl hover:-translate-y-2">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Biểu đồ ứng viên theo tháng</h3>
                    <button onclick="printChart()" class="px-6 py-3 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:via-indigo-700 hover:to-blue-700 transition duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-105">
                        🖨️ In biểu đồ
                    </button>
                </div>
                <canvas id="candidateChart" height="140" class="animate-fade-in"></canvas>
            </div>

            {{-- 3 ô đếm --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-purple-100 via-purple-50 to-indigo-100 p-8 rounded-3xl shadow-xl hover:shadow-2xl transition duration-500 ease-in-out transform hover:-translate-y-3 hover:scale-105">
                    <div class="text-purple-800 text-6xl font-extrabold mb-3 animate-bounce-slow">{{ $stats['total_cvs'] ?? 0 }}</div>
                    <div class="text-purple-700 font-semibold text-xl">Tổng số CV</div>
                </div>

                <div class="bg-gradient-to-br from-blue-100 via-blue-50 to-indigo-100 p-8 rounded-3xl shadow-xl hover:shadow-2xl transition duration-500 ease-in-out transform hover:-translate-y-3 hover:scale-105">
                    <div class="text-blue-800 text-6xl font-extrabold mb-3 animate-bounce-slow">{{ $stats['total_jobs'] ?? 0 }}</div>
                    <div class="text-blue-700 font-semibold text-xl">Tổng số công việc</div>
                </div>

                <div class="bg-gradient-to-br from-green-100 via-green-50 to-teal-100 p-8 rounded-3xl shadow-xl hover:shadow-2xl transition duration-500 ease-in-out transform hover:-translate-y-3 hover:scale-105">
                    <div class="text-green-800 text-6xl font-extrabold mb-3 animate-bounce-slow">{{ intval($percentClosed) }}%</div>
                    <div class="text-green-700 font-semibold text-xl">Tỷ lệ job đã đóng</div>
                </div>
            </div>
        </main>
    </div>
</div>

{{-- Script Chart --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function printChart() {
        const canvas = document.getElementById('candidateChart');
        const dataUrl = canvas.toDataURL();
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>In biểu đồ</title>
                    <style>
                        body { font-family: 'Inter', sans-serif; padding: 30px; text-align: center; background: linear-gradient(135deg, #f5f7fa, #c3cfe2); }
                        h2 { color: #1e3a8a; font-size: 2.5rem; margin-bottom: 25px; font-weight: 800; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1); }
                        img { max-width: 100%; border-radius: 16px; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); transition: transform 0.3s ease; }
                        img:hover { transform: scale(1.02); }
                    </style>
                </head>
                <body>
                    <h2>📈 Biểu đồ ứng viên theo tháng</h2>
                    <img src="${dataUrl}" alt="Biểu đồ ứng viên"/>
                    <script>window.onload = () => { window.print(); window.onafterprint = () => window.close(); };<\/script>
                </body>
            </html>`);
        printWindow.document.close();
    }

    const chartData = @json($chartData);
    new Chart(document.getElementById('candidateChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Apply',
                    data: chartData.apply,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.25)',
                    tension: 0.5,
                    pointBackgroundColor: '#0d6efd',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 10,
                    pointRadius: 6,
                    borderWidth: 3
                },
                {
                    label: 'Qualify',
                    data: chartData.qualify,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.25)',
                    tension: 0.5,
                    pointBackgroundColor: '#198754',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 10,
                    pointRadius: 6,
                    borderWidth: 3
                },
                {
                    label: 'Phỏng Vấn 1',
                    data: chartData.interview1,
                    borderColor: '#e83e8c',
                    backgroundColor: 'rgba(232, 62, 140, 0.25)',
                    tension: 0.5,
                    pointBackgroundColor: '#e83e8c',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 10,
                    pointRadius: 6,
                    borderWidth: 3
                },
                {
                    label: 'Phỏng Vấn 2',
                    data: chartData.interview2,
                    borderColor: '#fd7e14',
                    backgroundColor: 'rgba(253, 126, 20, 0.25)',
                    tension: 0.5,
                    pointBackgroundColor: '#fd7e14',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 10,
                    pointRadius: 6,
                    borderWidth: 3
                },
                {
                    label: 'Offer',
                    data: chartData.offer,
                    borderColor: '#20c997',
                    backgroundColor: 'rgba(32, 201, 151, 0.25)',
                    tension: 0.5,
                    pointBackgroundColor: '#20c997',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 10,
                    pointRadius: 6,
                    borderWidth: 3
                },
                {
                    label: 'Onboard',
                    data: chartData.hand,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.25)',
                    tension: 0.5,
                    pointBackgroundColor: '#dc3545',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 10,
                    pointRadius: 6,
                    borderWidth: 3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: { size: 15, family: 'Inter, sans-serif', weight: 'bold' },
                        padding: 25,
                        usePointStyle: true,
                        boxWidth: 12,
                        color: '#1e3a8a'
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    titleFont: { size: 15, family: 'Inter, sans-serif', weight: 'bold' },
                    bodyFont: { size: 14, family: 'Inter, sans-serif' },
                    padding: 15,
                    cornerRadius: 8
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
                        font: { size: 14, family: 'Inter, sans-serif' },
                        color: '#475569'
                    },
                    title: {
                        display: true,
                        text: 'Số lượng',
                        font: { size: 18, family: 'Inter, sans-serif', weight: 'bold' },
                        color: '#1e3a8a'
                    },
                    grid: { color: 'rgba(0, 0, 0, 0.05)', drawBorder: false }
                },
                x: {
                    ticks: {
                        font: { size: 14, family: 'Inter, sans-serif' },
                        color: '#475569'
                    },
                    grid: { display: false }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutElastic',
                delay: (context) => context.dataIndex * 100
            }
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }
    @keyframes bounceSlow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounceSlow 3s ease-in-out infinite;
    }
</style>
@endsection
