@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-3xl font-bold mb-4 text-gray-900">📝 Chọn công ty để xem Job</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($companies as $company)
                    <a href="{{ url('/jobs/company/' . $company->id) }}"
                       class="block bg-blue-100 hover:bg-blue-200 p-6 rounded-xl shadow text-center transition duration-200">
                        <h4 class="text-xl font-bold text-blue-800">{{ $company->name }}</h4>
                     <span class="text-sm text-gray-600">({{ $company->jobs_count }} jobs)</span>
                    </a>

                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
