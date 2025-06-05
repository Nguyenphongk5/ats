@extends('layouts.app')

@section('content')
  {{-- <a href="{{ route('jobs.statistics') }}"
                class="block bg-indigo-600 hover:bg-indigo-700 text-white p-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-3xl font-bold mb-2">➕ Thống kê</h3>
                <p class="text-white/90 text-lg">Xem thống kê chi tiết ứng viên và công việc.</p>
            </a> --}}
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-8">
            <h3 class="text-2xl font-bold mb-6 text-gray-800 text-center">📁 Pool Ứng Viên</h3>

            <div class="flex justify-between mb-6 gap-6">
                {{-- CxO --}}
                <div class="bg-indigo-100 p-6 rounded-lg shadow w-1/2">
                    <h4 class="text-xl font-semibold text-indigo-700 mb-4">🧑‍💼 CxO</h4>

                    @foreach ($cxos as $cxo)
                        <a href="{{ route('pool.show', $cxo->id) }}"
                           class="block mb-2 px-4 py-2 bg-white rounded shadow-sm text-indigo-800 font-medium hover:bg-indigo-200 transition">
                            {{ $cxo->position }}
                        </a>
                    @endforeach

                    <a href="{{ route('pool.create') }}"
                       class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        + Thêm mới CxO
                    </a>
                </div>

                {{-- Function --}}
                <div class="bg-green-100 p-6 rounded-lg shadow w-1/2">
                    <h4 class="text-xl font-semibold text-green-700 mb-4">🛠️ Function</h4>

                    @foreach ($functions as $function)
                        <a href="{{ route('pool.function.show', $function->id) }}"
                           class="block mb-2 px-4 py-2 bg-white rounded shadow-sm text-green-800 font-medium hover:bg-green-200 transition">
                            {{ $function->name }}
                        </a>
                    @endforeach

                    <a href="{{ route('pool.function.create') }}"
                       class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        + Thêm mới Function
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
