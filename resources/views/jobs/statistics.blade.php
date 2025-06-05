@extends('layouts.app')

@section('content')
    <div class="py-10 px-6 max-w-7xl mx-auto">
        <h2 class="text-4xl font-extrabold text-center mb-12 text-indigo-700">📊 Thống kê Job Offer</h2>

        <div class="flex justify-end space-x-4 mb-6">
            <button onclick="window.print()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded shadow-md transition">
                🖨️ In báo cáo
            </button>

            <button id="exportExcelBtn"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded shadow-md transition">
                📥 Xuất Excel
            </button>
        </div>
        <form method="GET" action="{{ route('jobs.statistics') }}" class="mb-6 flex items-center gap-4">
    <label for="month" class="font-semibold text-gray-700">Chọn tháng:</label>
    <input
        type="month"
        id="month"
        name="month"
        value="{{ request('month') }}"
        class="border rounded px-3 py-1"
    />
    <button
        type="submit"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded"
    >
        Lọc
    </button>

    @if(request('month'))
        <a href="{{ route('jobs.statistics') }}"
           class="ml-4 text-red-600 hover:underline font-semibold">
           Bỏ lọc
        </a>
    @endif
</form>

<form method="GET" action="{{ route('jobs.statistics') }}" class="mb-6 flex items-center gap-4">


    <label for="type" class="font-semibold text-gray-700">Loại công việc:</label>
    <select name="type" id="type" class="border rounded px-3 py-1">
        <option value="">Tất cả</option>
        <option value="manager" {{ request('type') == 'manager' ? 'selected' : '' }}>Quản lý</option>
        <option value="specialist" {{ request('type') == 'specialist' ? 'selected' : '' }}>Chuyên viên</option>
    </select>

    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded">
        Lọc
    </button>

    @if(request('month') || request('type'))
        <a href="{{ route('jobs.statistics') }}"
           class="ml-4 text-red-600 hover:underline font-semibold">
           Bỏ lọc
        </a>
    @endif
</form>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
            <table id="jobOfferTable" class="min-w-full text-left border-collapse">
                <thead class="bg-indigo-100 text-indigo-900 font-semibold text-lg select-none">
                    <tr>
                        <th class="border-b border-indigo-300 px-5 py-3">#</th>
                        <th class="border-b border-indigo-300 px-5 py-3">Tên Job</th>
                        <th class="border-b border-indigo-300 px-5 py-3">Loại</th>
                        <th class="border-b border-indigo-300 px-5 py-3">Ngày mở Job</th>
                        <th class="border-b border-indigo-300 px-5 py-3">Ngày Offer</th>
                        <th class="border-b border-indigo-300 px-5 py-3">Số ngày chờ</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($jobs as $index => $job)
                        @if ($job->cvs->whereNotNull('offer_date')->isNotEmpty())
                            @foreach ($job->cvs->whereNotNull('offer_date') as $cvIndex => $cv)
                                @php
                                    $offerDate = $cv->offer_date;
                               $days = (int) $job->created_at->diffInDays($offerDate);


                                    $isManager = $job->type === 'manager';
                                    $threshold = $isManager ? 60 : 45;

                                    $status = $days > $threshold ? '⏱ Chậm' : '✅ Đúng hạn';
                                    $statusColor = $days > $threshold ? 'text-red-600' : 'text-green-600';
                                @endphp
                                <tr class="hover:bg-indigo-50 transition">
                                    <td class="border-b border-indigo-200 px-5 py-3 whitespace-nowrap">
                                        {{ $index + 1 }}{{ $job->cvs->count() > 1 ? '.' . ($cvIndex + 1) : '' }}
                                    </td>
                                    <td class="border-b border-indigo-200 px-5 py-3">{{ $job->title }}</td>
                                    <td class="border-b border-indigo-200 px-5 py-3 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 rounded-full text-white {{ $isManager ? 'bg-blue-600' : 'bg-green-600' }}">
                                            {!! $isManager ? 'Quản lý' : 'Chuyên&nbsp;viên' !!}
                                        </span>
                                    </td>

                                    <td class="border-b border-indigo-200 px-5 py-3">
                                        {{ $job->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="border-b border-indigo-200 px-5 py-3">
                                        {{ $offerDate->format('d/m/Y') }}
                                    </td>
                                    <td class="border-b border-indigo-200 px-5 py-3">
                                        {{ $days }} ngày
                                        <span class="ml-2 font-semibold {{ $statusColor }}">{{ $status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="border-b border-indigo-200 px-5 py-3">{{ $index + 1 }}</td>
                                <td class="border-b border-indigo-200 px-5 py-3">{{ $job->title }}</td>
                                <td class="border-b border-indigo-200 px-5 py-3">
                                    <span
                                        class="px-3 py-1 rounded-full text-white {{ $job->type === 'manager' ? 'bg-blue-600' : 'bg-green-600' }}">
                                        {{ $job->type === 'manager' ? 'Quản lý' : 'Chuyên viên' }}
                                    </span>
                                </td>
                                <td class="border-b border-indigo-200 px-5 py-3">
                                    {{ $job->created_at->format('d/m/Y') }}
                                </td>
                                <td class="border-b border-indigo-200 px-5 py-3 text-gray-500 italic">Chưa offer</td>
                                <td class="border-b border-indigo-200 px-5 py-3 text-gray-500 italic">❌ Chưa offer</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Thư viện SheetJS để xuất Excel --}}
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById('exportExcelBtn').addEventListener('click', function() {
            const table = document.getElementById('jobOfferTable');
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Job Offer"
            });
            XLSX.writeFile(wb, 'thong_ke_job_offer.xlsx');
        });
    </script>

    {{-- Style in trang (nút, background v.v) --}}
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #jobOfferTable,
            #jobOfferTable * {
                visibility: visible;
            }

            #jobOfferTable {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                font-size: 12pt;
            }
        }
    </style>
@endsection
