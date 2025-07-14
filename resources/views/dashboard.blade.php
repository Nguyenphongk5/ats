@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-40 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-sky-200 rounded-full mix-blend-multiply filter blur-xl opacity-40 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-2000"></div>
    </div>

    <div class="relative z-10 pt-8 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl md:text-6xl font-black text-transparent bg-gradient-to-r from-blue-600 via-sky-500 to-blue-700 bg-clip-text mb-4">
                    📊 Analytics Dashboard
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Comprehensive recruitment analytics and insights at your fingertips
                </p>
            </div>

            <!-- Main Layout -->
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar -->
                <aside class="w-full lg:w-80 xl:w-96">
                    <div class="sticky top-8">
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-8 border border-blue-200/50 hover:border-blue-300/70 transition-all duration-500 hover:shadow-2xl">
                            <h3 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                                <span class="text-3xl">🎯</span>
                                <span class="bg-gradient-to-r from-blue-600 to-sky-600 bg-clip-text text-transparent">
                                    Navigation
                                </span>
                            </h3>
                            <nav class="space-y-3">
                                @foreach([
                                    ['url' => '/', 'label' => '🏠 Dashboard', 'gradient' => 'from-blue-500 to-sky-500'],
                                    ['url' => '/cv', 'label' => '📄 CV Library', 'gradient' => 'from-indigo-500 to-blue-500'],
                                    ['url' => '/jobs', 'label' => '💼 Job Listings', 'gradient' => 'from-sky-500 to-cyan-500'],
                                    ['url' => '/apply', 'label' => '📝 Add CV', 'gradient' => 'from-blue-600 to-indigo-600'],
                                    ['url' => '/pool', 'label' => '🎯 Talent Pool', 'gradient' => 'from-cyan-500 to-blue-500'],
                                    ['url' => route('jobs.statistics'), 'label' => '📈 Statistics', 'gradient' => 'from-sky-600 to-blue-600']
                                ] as $item)
                                    <a href="{{ url($item['url']) }}"
                                       class="group block p-4 rounded-2xl bg-gradient-to-r {{ $item['gradient'] }} text-white font-semibold
                                              hover:scale-105 hover:shadow-lg hover:shadow-blue-500/30
                                              transition-all duration-300 transform hover:-translate-y-1">
                                        <div class="flex items-center justify-between">
                                            <span>{{ $item['label'] }}</span>
                                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">→</span>
                                        </div>
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="flex-1 space-y-8">

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                        <div class="group relative bg-white/90 backdrop-blur-xl rounded-3xl p-8 border border-blue-200/50 hover:border-blue-300/70 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/20 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-sky-50/50 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-5xl">📄</div>
                                    <div class="text-right">
                                        <div class="text-4xl font-black text-gray-800 mb-1">{{ $stats['total_cvs'] ?? 0 }}</div>
                                        <div class="text-blue-600 font-semibold">Total CVs</div>
                                    </div>
                                </div>
                                <div class="w-full bg-blue-100 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-sky-500 h-2 rounded-full w-3/4 animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <div class="group relative bg-white/90 backdrop-blur-xl rounded-3xl p-8 border border-blue-200/50 hover:border-blue-300/70 transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/20 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 to-blue-50/50 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-5xl">💼</div>
                                    <div class="text-right">
                                        <div class="text-4xl font-black text-gray-800 mb-1">{{ $stats['total_jobs'] ?? 0 }}</div>
                                        <div class="text-indigo-600 font-semibold">Active Jobs</div>
                                    </div>
                                </div>
                                <div class="w-full bg-indigo-100 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 h-2 rounded-full w-4/5 animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <div class="group relative bg-white/90 backdrop-blur-xl rounded-3xl p-8 border border-blue-200/50 hover:border-blue-300/70 transition-all duration-500 hover:shadow-2xl hover:shadow-emerald-500/20 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-blue-50/50 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-5xl">✅</div>
                                    <div class="text-right">
                                        <div class="text-4xl font-black text-gray-800 mb-1">{{ intval($percentClosed) }}%</div>
                                        <div class="text-emerald-600 font-semibold">Success Rate</div>
                                    </div>
                                </div>
                                <div class="w-full bg-emerald-100 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 rounded-full w-full animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="space-y-8">

                        <!-- Line Chart -->
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-8 border border-blue-200/50 hover:border-blue-300/70 transition-all duration-500">
                            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-6">
                                <div>
                                    <h3 class="text-3xl font-bold text-gray-800 mb-2 flex items-center gap-3">
                                        <span class="text-4xl">📈</span>
                                        Candidate Analytics
                                    </h3>
                                    <p class="text-gray-600">Track recruitment progress over time</p>
                                </div>

                                <!-- Month Filter -->
                                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col sm:flex-row items-end gap-4">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Start Month:</label>
                                            <input type="month" name="start_month"
                                                   class="px-4 py-2 bg-white border border-blue-200 rounded-xl text-gray-700 placeholder-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/50 transition-all duration-300">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">End Month:</label>
                                            <input type="month" name="end_month"
                                                   class="px-4 py-2 bg-white border border-blue-200 rounded-xl text-gray-700 placeholder-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/50 transition-all duration-300">
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit"
                                                class="px-6 py-2 bg-gradient-to-r from-blue-500 to-sky-500 text-white rounded-xl hover:from-blue-600 hover:to-sky-600 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                                            📅 Filter
                                        </button>
                                        <a href="{{ route('dashboard') }}"
                                           class="px-6 py-2 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-xl hover:from-gray-500 hover:to-gray-600 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                                            🔄 Reset
                                        </a>
                                    </div>
                                </form>
                            </div>

                            <div class="relative">
                                <button onclick="printChart()"
                                        class="absolute top-4 right-4 z-10 px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-500 text-white rounded-xl hover:from-indigo-600 hover:to-blue-600 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                                    🖨️ Print
                                </button>
                                <div class="bg-blue-50/50 rounded-2xl p-6 backdrop-blur-sm border border-blue-100">
                                    <canvas id="candidateChart" height="420"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Funnel Chart -->
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-8 border border-blue-200/50 hover:border-blue-300/70 transition-all duration-500">
                            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-6">
                                <div>
                                    <h3 class="text-3xl font-bold text-gray-800 mb-2 flex items-center gap-3">
                                        <span class="text-4xl">🎯</span>
                                        Recruitment Funnel
                                    </h3>
                                    <p class="text-gray-600">Visualize the recruitment pipeline</p>
                                </div>

                                <!-- Funnel Filter -->
                                <form id="funnel-filter-form" class="flex flex-col sm:flex-row gap-4 items-end">
                                    <div class="flex-1 min-w-64">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Job:</label>
                                        <select name="job_id" id="filter-job-id"
                                                class="w-full px-4 py-2 bg-white border border-blue-200 rounded-xl text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/50 transition-all duration-300">
                                            <option value="">All Jobs</option>
                                            @foreach($jobs as $job)
                                                <option value="{{ $job->id }}">{{ $job->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit"
                                                class="px-6 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                                            🔍 Filter
                                        </button>
                                        <button type="button" id="reset-funnel"
                                                class="px-6 py-2 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-xl hover:from-gray-500 hover:to-gray-600 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                                            🔄 Reset
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="bg-blue-50/50 rounded-2xl p-6 backdrop-blur-sm border border-blue-100">
                                <div id="funnel-chart" class="w-full h-96"></div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://d3js.org/d3.v7.min.js"></script>

<!-- Line Chart Script -->
<script>
const chartData = @json($chartData);
const ctx = document.getElementById('candidateChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.labels,
        datasets: [
            {
                label: 'Apply',
                data: chartData.apply,
                borderColor: '#0ea5e9',
                backgroundColor: 'rgba(14, 165, 233, 0.1)',
                tension: 0.4,
                borderWidth: 4,
                fill: true,
                pointBackgroundColor: '#0ea5e9',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            },
            {
                label: 'Qualify',
                data: chartData.qualify,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                borderWidth: 4,
                fill: true,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            },
            {
                label: 'Interview 1',
                data: chartData.interview1,
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4,
                borderWidth: 4,
                fill: true,
                pointBackgroundColor: '#f59e0b',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            },
            {
                label: 'Interview 2',
                data: chartData.interview2,
                borderColor: '#8b5cf6',
                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                tension: 0.4,
                borderWidth: 4,
                fill: true,
                pointBackgroundColor: '#8b5cf6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            },
            {
                label: 'Offer',
                data: chartData.offer,
                borderColor: '#ec4899',
                backgroundColor: 'rgba(236, 72, 153, 0.1)',
                tension: 0.4,
                borderWidth: 4,
                fill: true,
                pointBackgroundColor: '#ec4899',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            },
            {
                label: 'Onboard',
                data: chartData.hand,
                borderColor: '##FF0000',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                borderWidth: 4,
                fill: true,
                pointBackgroundColor: '##FF0000',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: '#374151',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    padding: 20,
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                titleColor: '#374151',
                bodyColor: '#6b7280',
                borderColor: '#0ea5e9',
                borderWidth: 1,
                cornerRadius: 12,
                padding: 12,
                displayColors: true,
                mode: 'index',
                intersect: false
            }
        },
        scales: {
            x: {
                grid: {
                    color: 'rgba(59, 130, 246, 0.1)',
                    drawBorder: false
                },
                ticks: {
                    color: '#6b7280',
                    font: {
                        size: 12,
                        weight: 'bold'
                    }
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(59, 130, 246, 0.1)',
                    drawBorder: false
                },
                ticks: {
                    color: '#6b7280',
                    font: {
                        size: 12,
                        weight: 'bold'
                    }
                }
            }
        },
        interaction: {
            mode: 'nearest',
            axis: 'x',
            intersect: false
        },
        elements: {
            point: {
                hoverBorderWidth: 4
            }
        }
    }
});
</script>

<!-- Funnel Chart Scripts -->
<script>
document.getElementById('funnel-filter-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const jobId = document.getElementById('filter-job-id').value;
    fetch(`{{ route('dashboard.funnel') }}?job_id=${jobId}`)
        .then(res => res.json())
        .then(data => renderFunnelChart(data));
});

document.getElementById('reset-funnel').addEventListener('click', function () {
    document.getElementById('filter-job-id').value = '';
    fetch(`{{ route('dashboard.funnel') }}`)
        .then(res => res.json())
        .then(data => renderFunnelChart(data));
});

function renderFunnelChart(funnelData) {
    const container = document.getElementById('funnel-chart');
    container.innerHTML = '';

    if (!funnelData || Object.keys(funnelData).length === 0) {
        container.innerHTML = '<div class="text-center text-gray-500 py-16 text-xl">📊 No data available to display</div>';
        return;
    }

    const data = Object.entries(funnelData).map(([key, value], i) => ({
        label: key,
        value,
        percentage: value > 0 ? ((value / Object.values(funnelData)[0]) * 100).toFixed(1) : 0
    }));

    const colors = ['#0ea5e9', '#3b82f6', '#10b981', '#f59e0b', '#ec4899', '#8b5cf6'];
    const width = Math.min(container.offsetWidth, 700);
    const height = 400;
    const margin = { top: 20, bottom: 20, left: 20, right: 20 };

    const svg = d3.select(container)
        .append('svg')
        .attr('width', width)
        .attr('height', height)
        .attr('viewBox', `0 0 ${width} ${height}`)
        .style('background', 'transparent');

    const maxValue = Math.max(...data.map(d => d.value));
    const segmentHeight = (height - margin.top - margin.bottom - (data.length - 1) * 12) / data.length;

    data.forEach((d, i) => {
        const segWidth = Math.max((d.value / maxValue) * (width - 200), 60);
        const x = (width - segWidth) / 2;
        const y = margin.top + i * (segmentHeight + 12);

        const group = svg.append('g');

        // Add glow effect
        const defs = svg.append('defs');
        const filter = defs.append('filter')
            .attr('id', `glow-${i}`)
            .attr('x', '-50%')
            .attr('y', '-50%')
            .attr('width', '200%')
            .attr('height', '200%');

        filter.append('feGaussianBlur')
            .attr('stdDeviation', '3')
            .attr('result', 'coloredBlur');

        const feMerge = filter.append('feMerge');
        feMerge.append('feMergeNode').attr('in', 'coloredBlur');
        feMerge.append('feMergeNode').attr('in', 'SourceGraphic');

        // Main rectangle with gradient
        const gradient = defs.append('linearGradient')
            .attr('id', `gradient-${i}`)
            .attr('x1', '0%')
            .attr('y1', '0%')
            .attr('x2', '100%')
            .attr('y2', '100%');

        gradient.append('stop')
            .attr('offset', '0%')
            .attr('stop-color', colors[i % colors.length])
            .attr('stop-opacity', 1);

        gradient.append('stop')
            .attr('offset', '100%')
            .attr('stop-color', colors[i % colors.length])
            .attr('stop-opacity', 0.6);

        group.append('rect')
            .attr('x', x)
            .attr('y', y)
            .attr('width', 0)
            .attr('height', segmentHeight)
            .attr('rx', 16)
            .attr('ry', 16)
            .attr('fill', `url(#gradient-${i})`)
            .attr('filter', `url(#glow-${i})`)
            .style('cursor', 'pointer')
            .transition()
            .duration(1000)
            .delay(i * 150)
            .attr('width', segWidth)
            .ease(d3.easeElasticOut);

        // Label text
        group.append('text')
            .attr('x', x + segWidth / 2)
            .attr('y', y + segmentHeight / 2 - 8)
            .attr('text-anchor', 'middle')
            .style('fill', 'white')
            .style('font-weight', 'bold')
            .style('font-size', '16px')
            .style('opacity', 0)
            .text(d.label)
            .transition()
            .duration(500)
            .delay(i * 150 + 800)
            .style('opacity', 1);

        // Value text
        group.append('text')
            .attr('x', x + segWidth / 2)
            .attr('y', y + segmentHeight / 2 + 12)
            .attr('text-anchor', 'middle')
            .style('fill', 'white')
            .style('font-size', '14px')
            .style('opacity', 0)
            .text(d.value.toLocaleString())
            .transition()
            .duration(500)
            .delay(i * 150 + 1000)
            .style('opacity', 1);

        // Percentage text
        svg.append('text')
            .attr('x', x + segWidth + 24)
            .attr('y', y + segmentHeight / 2 + 4)
            .attr('text-anchor', 'start')
            .style('fill', colors[i % colors.length])
            .style('font-weight', 'bold')
            .style('font-size', '18px')
            .style('opacity', 0)
            .text(d.percentage + '%')
            .transition()
            .duration(500)
            .delay(i * 150 + 1200)
            .style('opacity', 1);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    renderFunnelChart(@json($funnelData));
});
</script>

<!-- Print Chart Script -->
<script>
function printChart() {
    const canvas = document.getElementById('candidateChart');
    const dataUrl = canvas.toDataURL('image/png', 1.0);
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>Candidate Analytics Chart</title>
            <style>
                body {
                    font-family: system-ui, -apple-system, sans-serif;
                    margin: 0;
                    padding: 40px;
                    text-align: center;
                    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
                    color: #1f2937;
                }
                .header {
                    margin-bottom: 30px;
                }
                .title {
                    font-size: 32px;
                    font-weight: bold;
                    margin-bottom: 10px;
                    color: #1e40af;
                }
                .subtitle {
                    font-size: 16px;
                    opacity: 0.8;
                    color: #6b7280;
                }
                .chart-container {
                    background: rgba(255, 255, 255, 0.9);
                    border-radius: 20px;
                    padding: 30px;
                    backdrop-filter: blur(10px);
                    box-shadow: 0 25px 50px rgba(59, 130, 246, 0.15);
                    border: 1px solid rgba(59, 130, 246, 0.2);
                }
                img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 15px;
                }
                .footer {
                    margin-top: 30px;
                    font-size: 14px;
                    opacity: 0.7;
                    color: #6b7280;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="title">📈 Candidate Analytics Chart</div>
                <div class="subtitle">Generated on ${new Date().toLocaleDateString()}</div>
            </div>
            <div class="chart-container">
                <img src="${dataUrl}" alt="Candidate Analytics Chart" />
            </div>
            <div class="footer">
                Recruitment Dashboard Analytics Report
            </div>
            <script>
                window.onload = function() {
                    setTimeout(function() {
                        window.print();
                        window.onafterprint = function() {
                            window.close();
                        };
                    }, 500);
                };
            <\/script>
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
}
</script>
<style>
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes glow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    50% {
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-glow {
    animation: glow 2s ease-in-out infinite;
}

.animate-slide-in {
    animation: slideIn 0.6s ease-out;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

/* Smooth scrolling for the entire page */
html {
    scroll-behavior: smooth;
}

/* Custom scrollbar styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(59, 130, 246, 0.1);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #3b82f6, #0ea5e9);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #2563eb, #0284c7);
}

/* Enhanced button hover effects */
.btn-primary {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transition: all 0.5s ease;
    transform: translate(-50%, -50%);
}

.btn-primary:hover::before {
    width: 300px;
    height: 300px;
}

/* Loading animation for charts */
.chart-loading {
    position: relative;
}

.chart-loading::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    border: 4px solid rgba(59, 130, 246, 0.3);
    border-top: 4px solid #3b82f6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    transform: translate(-50%, -50%);
    z-index: 10;
}

@keyframes spin {
    0% {
        transform: translate(-50%, -50%) rotate(0deg);
    }
    100% {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

/* Enhanced card interactions */
.stat-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 50px rgba(59, 130, 246, 0.15);
}

/* Glassmorphism effect for navigation */
.glass-nav {
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Responsive design enhancements */
@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .chart-container {
        padding: 1rem;
    }

    .nav-item {
        padding: 0.75rem;
        font-size: 0.875rem;
    }
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }

    .print-only {
        display: block !important;
    }

    body {
        background: white !important;
        color: black !important;
    }

    .bg-gradient-to-br {
        background: white !important;
    }

    .shadow-xl {
        box-shadow: none !important;
    }
}

/* Dark mode support (optional) */
@media (prefers-color-scheme: dark) {
    .dark-mode-support {
        background: #1f2937;
        color: #f9fafb;
    }

    .dark-mode-support .bg-white {
        background: #374151 !important;
    }

    .dark-mode-support .text-gray-800 {
        color: #f9fafb !important;
    }
}

/* Accessibility improvements */
.focus-visible:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .gradient-text {
        background: none !important;
        color: #000 !important;
    }

    .bg-gradient-to-r {
        background: #3b82f6 !important;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

@endsection
