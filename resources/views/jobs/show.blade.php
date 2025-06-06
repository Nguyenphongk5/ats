@extends('layouts.app')

@section('content')
    <div class="py-5" style="max-width: 1200px; margin: 0 auto; padding-left: 15px; padding-right: 15px;">

        {{-- 🟦 Tiêu đề công việc --}}
        <h2 class="mb-5 fw-bold text-primary" style="font-size: 1.85rem; letter-spacing: 0.03em;">
            {{ $job->title }}
        </h2>

        {{-- ✅ Hiển thị thông báo khi tải CV thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded shadow-sm mb-4" role="alert"
                style="font-size: 0.9rem;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- 📅 Thời gian ứng tuyển --}}
        <div class="mb-4" style="font-size: 1rem;">
            <h6 class="fw-semibold text-secondary mb-2">⏳ Thời gian ứng tuyển</h6>
            <p class="text-muted mb-3">
                {{-- Nếu có ngày thì hiển thị, không thì báo "Chưa cập nhật" --}}
                {{ $job->start_date ? $job->start_date->format('d/m/Y') : 'Chưa cập nhật' }}
            </p>
            {{-- Số lượng cần tuyển --}}
<div class="d-flex align-items-center gap-2">
    <span class="fw-semibold text-secondary">Headcounts: </span>
    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
        {{ $job->vacancy }}
    </span>
</div>

{{-- Trạng thái công việc --}}
<div class="d-flex align-items-center gap-2 mt-2">
    <span class="fw-semibold text-secondary">Status: </span>
    <span class="badge {{ $job->status === 'open' ? 'bg-success' : 'bg-danger' }} px-3 py-2 rounded-pill">
        {{ $job->status === 'open' ? 'Open' : 'Closed' }}
    </span>
</div>
    <br>
            {{-- 📊 Các nút trạng thái ứng viên cùng số lượng --}}
            <div class="d-flex flex-wrap gap-3">
                {{-- Số lượng CV đã nộp --}}
                <div class="d-flex align-items-center gap-2">
                    <button type="button"
                        class="btn btn-outline-primary btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm d-flex align-items-center">
                        Apply
                        <span class="badge bg-secondary text-white ms-2">
                            {{ $job->cvs_count ?? $job->cvs()->count() }}
                        </span>
                    </button>
                </div>

                {{-- Số lượng đã qualify --}}
                <button type="button" class="btn btn-outline-secondary btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                    style="min-width: 110px;">
                    Qualify
                    <span id="qualifiedCountSpan" class="badge bg-secondary text-white ms-2">
                        {{ $job->qualified_count ?? 0 }}
                    </span>
                </button>

                {{-- Số lượng phỏng vấn vòng 1 --}}
                <button type="button" class="btn btn-outline-secondary btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                    style="min-width: 110px;">
                    Phỏng Vấn 1
                    <span id="qualifiedCountSpan" class="badge bg-secondary text-white ms-2">
                        {{ $job->interview1_count ?? 0 }}
                    </span>
                </button>

                {{-- Số lượng phỏng vấn vòng 2 --}}
                <button type="button" class="btn btn-outline-info btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                    style="min-width: 110px;">
                    Phỏng vấn 2
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                        {{ $job->interview2_count ?? 0 }}
                    </span>
                </button>

                {{-- Số lượng được offer --}}
                <button type="button" class="btn btn-outline-success btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                    style="min-width: 110px;">
                    Offer
                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                        {{ $job->offer_count ?? 0 }}
                    </span>
                </button>

                {{-- Số lượng đã nhận việc (hand) --}}
                <button type="button" class="btn btn-outline-dark btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
                    style="min-width: 110px;">
                    Onboard
                    <span class="badge bg-dark px-3 py-2 rounded-pill">
                        {{ $job->hand_count ?? 0 }}
                    </span>
                </button>
            </div>
        </div>

        {{-- 📝 Mô tả công việc --}}
       @php
    $isCollapsed = true;
@endphp

<div
    id="job-description"
    class="border rounded-3 p-4 mb-5 shadow-sm text-gray-800 bg-[#fafafa]"
    style="font-size: 1rem; white-space: pre-line; color: #333; cursor: pointer; max-height: 6.25rem; overflow: hidden; transition: max-height 0.3s ease;"
    onclick="toggleDescription()"
>
    {!! nl2br(e($job->description)) !!}
</div>

<div class="mb-5 text-indigo-600 cursor-pointer font-semibold select-none" onclick="toggleDescription()" id="toggle-btn">
    Xem thêm ▼
</div>

<script>
    const desc = document.getElementById('job-description');
    const btn = document.getElementById('toggle-btn');
    let collapsed = true;

    function toggleDescription() {
        if (collapsed) {
            // Mở rộng
            desc.style.maxHeight = desc.scrollHeight + "px"; // chiều cao nội dung thực tế
            btn.textContent = "Thu gọn ▲";
        } else {
            // Thu gọn
            desc.style.maxHeight = "6.25rem"; // giới hạn 5 dòng
            btn.textContent = "Xem thêm ▼";
        }
        collapsed = !collapsed;
    }
</script>


        {{-- 🎯 Nút hành động --}}
        <div class="d-flex justify-content-start gap-3 flex-wrap align-items-center">
            {{-- Nút ứng tuyển --}}
           @if ($job->status === 'open')
    <a href="{{ route('jobs.apply', $job->id) }}"
        class="btn btn-success btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
        style="font-size: 0.95rem;">
        <i class="bi bi-pencil-square me-2"></i> Add CV  
    </a>
@endif


            {{-- Nút xem danh sách CV --}}
           <a href="{{ route('cv.index.job', $job->id) }}"
   class="btn btn-outline-primary btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
   style="font-size: 0.95rem; transition: color 0.3s ease, border-color 0.3s ease;">
   <i class="bi bi-card-list me-2"></i> List CV
</a>

        </div>

    </div>
@endsection
