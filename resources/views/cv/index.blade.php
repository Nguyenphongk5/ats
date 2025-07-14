@extends('layouts.app')

@section('content')
@php
    $cvsGrouped = $cvs->groupBy(function ($cv) {
        if ($cv->job_id) return $cv->job_id;
        if ($cv->cxo_id) return 'pool_' . $cv->cxo_id;
        if ($cv->function_id) return 'function_' . $cv->function_id;
        return 'unknown';
    });
@endphp

    <div class="cv-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">
                    <span class="title-icon">✨</span>
                    <span class="title-text">Danh sách CV</span>
                    <span class="title-icon">✨</span>
                </h1>
                <div class="hero-subtitle">Quản lý hồ sơ ứng viên một cách chuyên nghiệp</div>
            </div>
            <div class="hero-decoration">
                <div class="floating-element element-1"></div>
                <div class="floating-element element-2"></div>
                <div class="floating-element element-3"></div>
            </div>
        </div>

        <!-- Filter Section -->
        @if (!isset($jobId))
            <div class="filter-section">
                <div class="filter-card">
                    <form method="GET" action="{{ route('cv.index') }}" class="filter-form">
                        <div class="filter-group">
                            <label for="job_id" class="filter-label">
                                <i class="filter-icon">🔍</i>
                                Lọc theo Job
                            </label>
                            <div class="select-wrapper">
                                <select name="job_id" id="job_id" class="filter-select">
                                    <option value="">🌟 Tất cả CV</option>
                                    <optgroup label="📋 Vị trí công việc">
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->id }}"
                                                {{ request('job_id') == $job->id ? 'selected' : '' }}>
                                                {{ $job->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="🏆 CxO">
                                        @foreach ($cxos as $cxo)
                                            <option value="pool_{{ $cxo->id }}"
                                                {{ request('job_id') == 'pool_' . $cxo->id ? 'selected' : '' }}>
                                                {{ $cxo->position }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="📂 Function">
                                        @foreach ($functions as $function)
                                            <option value="function_{{ $function->id }}"
                                                {{ request('job_id') == 'function_' . $function->id ? 'selected' : '' }}>
                                                {{ $function->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                <div class="select-arrow">
                                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none">
                                        <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="filter-btn">
                            <span class="btn-content">
                                <i class="btn-icon">🎯</i>
                                <span>Áp dụng lọc</span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="active-filter-section">
                <div class="active-filter-card">
                    <div class="active-filter-info">
                        <div class="active-filter-label">Đang hiển thị:</div>
                        <div class="active-filter-value">
                            @if (str_starts_with($jobId, 'pool_'))
                                🏆
                                {{ $cxos->firstWhere('id', str_replace('pool_', '', $jobId))?->position ?? 'Không xác định' }}
                            @else
                                📋 {{ $jobs->firstWhere('id', $jobId)?->title ?? 'Không xác định' }}
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('cv.index') }}" class="reset-filter-btn">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zM5.5 6.5L8 9m0 0l2.5 2.5M8 9l2.5-2.5M8 9l-2.5 2.5"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        Xóa bộ lọc
                    </a>
                </div>
            </div>
        @endif

        <!-- CV Groups Section -->
        <div class="cv-groups-section">

            @forelse($cvsGrouped as $groupId => $groupedCvs)
                <div class="group-container">
                    <div class="group-header">
                        <div class="group-title">
                            <div class="group-icon">
                                @if (str_starts_with($groupId, 'pool_'))
                                    🏆
                                @else
                                    📋
                                @endif
                            </div>
                            <div class="group-text">
                              <div class="group-type">
    @if (str_starts_with($groupId, 'pool_'))
        CxO
    @elseif (str_starts_with($groupId, 'function_'))
        Function
    @else
        Vị trí công việc
    @endif
</div>
<div class="group-name text-xl font-bold text-indigo-800">
    @if (str_starts_with($groupId, 'pool_'))
        {{ $groupedCvs->first()->cxo?->position ?? 'Không xác định' }}
    @elseif (str_starts_with($groupId, 'function_'))
        {{ $groupedCvs->first()->function?->name ?? 'Không xác định' }}
    @else
        {{ $groupedCvs->first()->job?->title ?? 'Không xác định' }}
    @endif
</div>


                            </div>
                        </div>
                        <div class="group-count">
                            <span class="count-number">{{ count($groupedCvs) }}</span>
                            <span class="count-text">CV</span>
                        </div>
                    </div>

                    <div class="cv-grid">
                        @foreach ($groupedCvs as $cv)
                            <div class="cv-card">
                                <div class="cv-card-header">
                                    <div class="cv-avatar">
                                        {{ strtoupper(substr($cv->full_name ?? 'N', 0, 1)) }}
                                    </div>
                                    <div class="cv-basic-info">
                                        <div class="cv-name">{{ $cv->full_name ?? 'Không có tên' }}</div>
                                        <div class="cv-birth-year">
                                            <i class="info-icon">🎂</i>
                                            {{ $cv->birth_year ?? 'Không có' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="cv-details">
                                    <div class="cv-detail-item">
                                        <div class="detail-label">
                                            <i class="detail-icon">🏢</i>
                                            Công ty
                                        </div>
                                        <div class="detail-value">{{ $cv->last_company ?? 'Không có' }}</div>
                                    </div>

                                    <div class="cv-detail-item">
                                        <div class="detail-label">
                                            <i class="detail-icon">💼</i>
                                            Chức danh
                                        </div>
                                        <div class="detail-value">{{ $cv->last_position ?? 'Không có' }}</div>
                                    </div>

                                    <div class="cv-detail-item">
                                        <div class="detail-label">
                                            <i class="detail-icon">📅</i>
                                            Ngày nộp
                                        </div>
                                        <div class="detail-value">{{ $cv->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                <div class="cv-actions">
                                    <a href="{{ route('cv.view', $cv->id) }}" target="_blank" class="view-cv-btn">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path
                                                d="M8 3C4.5 3 1.73 5.61 1 8c.73 2.39 3.5 5 7 5s6.27-2.61 7-5c-.73-2.39-3.5-5-7-5z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" stroke="currentColor"
                                                stroke-width="1.5" />
                                        </svg>
                                        Xem CV
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <div class="empty-title">Chưa có CV nào</div>
                    <div class="empty-subtitle">Hãy chờ đợi các ứng viên nộp hồ sơ</div>
                </div>
            @endforelse
            <!-- CV Groups Section -->
<div class="cv-groups-section">
    @forelse($cvsGrouped as $groupId => $groupedCvs)
        {{-- hiển thị từng nhóm CV --}}
    @empty
        <div class="empty-state">...</div>
    @endforelse

    {{-- Pagination ở dưới cùng --}}
    <div class="pagination-wrapper mt-4">
        {{ $cvs->appends(request()->query())->links() }}
    </div>
</div>

        </div>
    </div>

    <style>
        * {
            box-sizing: border-box;
        }

        .cv-container {
            min-height: 100vh;
            background: #ffffff;
            padding: 0;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 40px;
            text-align: center;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 12px 0;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .title-icon {
            font-size: 0.8em;
            animation: sparkle 2s infinite;
        }

        .title-text {
            background: linear-gradient(45deg, #ffffff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 300;
            margin-top: 8px;
        }

        .hero-decoration {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .element-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .element-2 {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 15%;
            animation-delay: -2s;
        }

        .element-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: -4s;
        }

        /* Filter Section */
        .filter-section {
            padding: 40px 40px;
            background: #f8fafc;
        }

        .filter-card {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .filter-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .filter-label {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-icon {
            font-size: 1.1em;
        }

        .select-wrapper {
            position: relative;
        }

        .filter-select {
            width: 100%;
            padding: 12px 40px 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            background: #ffffff;
            transition: all 0.3s ease;
            appearance: none;
            cursor: pointer;
        }

        .filter-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .select-arrow {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #64748b;
            transition: transform 0.3s ease;
        }

        .filter-select:focus+.select-arrow {
            transform: translateY(-50%) rotate(180deg);
        }

        .filter-btn {
            align-self: flex-start;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-content {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-icon {
            font-size: 1em;
        }

        /* Active Filter Section */
        .active-filter-section {
            padding: 30px 40px 0;
            background: #f8fafc;
        }

        .active-filter-card {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .active-filter-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .active-filter-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
        }

        .active-filter-value {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
        }

        .reset-filter-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #f1f5f9;
            color: #64748b;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .reset-filter-btn:hover {
            background: #e2e8f0;
            color: #1e293b;
            text-decoration: none;
        }

        /* CV Groups Section */
        .cv-groups-section {
            padding: 40px 40px;
            background: #f8fafc;
        }

        .group-container {
            max-width: 1000px;
            margin: 0 auto 40px;
        }

        .group-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0 16px;
        }

        .group-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .group-icon {
            font-size: 1.8rem;
            line-height: 1;
        }

        .group-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .group-type {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .group-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
        }

        .group-count {
            display: flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
        }

        .count-number {
            font-size: 1rem;
            font-weight: 700;
        }

        .count-text {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        /* CV Grid */
        .cv-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 18px;
            padding: 0 16px;
        }

        .cv-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cv-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .cv-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .cv-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            color: #ffffff;
            text-transform: uppercase;
        }

        .cv-basic-info {
            flex: 1;
        }

        .cv-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .cv-birth-year {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #64748b;
            font-size: 0.85rem;
        }

        .info-icon {
            font-size: 1em;
        }

        .cv-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 18px;
        }

        .cv-detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .detail-icon {
            font-size: 1em;
        }

        .detail-value {
            font-size: 0.9rem;
            color: #1e293b;
            font-weight: 500;
            padding-left: 18px;
        }

        .cv-actions {
            display: flex;
            justify-content: flex-end;
        }

        .view-cv-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
            font-size: 0.85rem;
        }

        .view-cv-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
            color: #ffffff;
            text-decoration: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 40px;
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 16px;
            opacity: 0.6;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .empty-subtitle {
            font-size: 1rem;
            color: #64748b;
            font-weight: 400;
        }

        /* Animations */
        @keyframes sparkle {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
            }

            50% {
                transform: scale(1.2) rotate(180deg);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                padding: 30px 20px;
            }

            .hero-title {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 8px;
            }

            .filter-section,
            .cv-groups-section {
                padding: 30px 20px;
            }

            .filter-card {
                padding: 20px;
            }

            .filter-form {
                gap: 16px;
            }

            .filter-btn {
                align-self: stretch;
                justify-content: center;
            }

            .active-filter-card {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .group-header {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .cv-grid {
                grid-template-columns: 1fr;
                padding: 0;
            }

            .cv-card {
                padding: 16px;
            }

            .group-name {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.6rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .cv-card-header {
                flex-direction: column;
                text-align: center;
            }

            .cv-avatar {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .cv-name {
                font-size: 1rem;
            }
        }
    </style>

@endsection
