@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <h3 class="text-3xl font-bold mb-6 text-gray-900">Công việc đã đóng - Công ty: {{ $company->name }}</h3>

        @if($closedJobs->count() > 0)
            <ul class="space-y-4">
                @foreach($closedJobs as $job)
                    <li class="p-4 bg-red-50 rounded shadow">
                        <h4 class="text-xl font-semibold">{{ $job->title }}</h4>
                        <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($job->description, 120) }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="text-red-700 hover:underline">Xem chi tiết</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Hiện tại không có công việc nào đã đóng.</p>
        @endif

    </div>
</div>
@endsection
