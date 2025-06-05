@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center flex items-center justify-center gap-2">
                <span>🔍</span> Chi tiết Function
            </h2>

            <div class="bg-green-100 p-6 rounded-lg shadow-inner mb-10">
                <h3 class="text-2xl font-semibold text-green-700 border-b border-green-300 pb-2">
                    Tên Function
                </h3>
                <p class="text-green-900 mt-3 text-lg font-medium tracking-wide">
                    {{ $function->name }}
                </p>
            </div>

            @foreach ($function->jobs as $job)
                <div class="mt-6 bg-white border border-gray-300 rounded-lg p-6 shadow hover:shadow-md transition duration-300">
                    <h4 class="text-xl font-semibold text-gray-800 mb-3">
                        Mô tả công việc:
                    </h4>
                    <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                        {{ $job->description }}
                    </p>

                    {{-- <div class="mt-6 flex flex-wrap gap-4">
                     <a href="{{ route('jobs.apply', ['job' => $job->id]) }}"
   class="btn btn-success btn-sm px-4 py-2 fw-semibold rounded-pill shadow-sm"
   style="font-size: 0.95rem;">
   <i class="bi bi-pencil-square me-2"></i> Add Job
</a> --}}
                        {{-- <a href="{{ route('cv.index.job', ['job_id' => $job->id]) }}"
                           class="inline-block px-5 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                            📋 Danh sách CV
                        </a>
                    </div>
                </div> --}}
            @endforeach

            <div class="text-center mt-12">
                <a href="{{ route('pool.index') }}"
                   class="inline-block px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-semibold">
                    ← Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
