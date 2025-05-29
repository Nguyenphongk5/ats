@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Thống kê ứng viên</h2>

    <form method="GET" action="{{ route('candidates.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="month" class="form-label">Chọn tháng:</label>
            <input type="month" id="month" name="month" class="form-control" value="{{ request('month') }}">
        </div>
        <div class="col-md-4">
            <label for="filter_field" class="form-label">Lọc theo giai đoạn:</label>
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
            <button type="submit" class="btn btn-primary w-100">Lọc</button>
        </div>
    </form>

    <h5 class="text-center mt-5 mb-3">Biểu đồ số lượng ứng viên theo từng giai đoạn (12 tháng)</h5>
    <canvas id="candidateChart" height="100"></canvas>
</div>
<br>
<br>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    label: 'PV1',
                    data: chartData.interview1,
                    borderColor: '#ffc107',
                    backgroundColor: '#ffc10733',
                    tension: 0.4,
                    fill: false
                },
                {
                    label: 'PV2',
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
                    label: 'Hand Job',
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
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Biểu đồ ứng viên theo từng giai đoạn (12 tháng)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
