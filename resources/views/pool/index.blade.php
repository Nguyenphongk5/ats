@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight text-center md:text-left">
            {{ __('Danh sách Pool ứng viên') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl p-8">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 text-center">📁 Pool Ứng Viên</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Cột CxO -->
           <div class="bg-indigo-100 p-6 rounded-lg shadow">
    <h4 class="text-xl font-semibold text-indigo-700 mb-4">🧑‍💼 CxO</h4>
    @foreach ($cxos as $cxo)
        <a href="{{ route('pool.cxo.show', $cxo->id) }}" class="block mb-2 px-4 py-2 bg-white rounded shadow-sm text-indigo-800 font-medium hover:bg-indigo-200 transition">
            {{ $cxo->position }}
        </a>
    @endforeach
</div>


                    <!-- Cột Function -->
                   <div class="bg-green-100 p-6 rounded-lg shadow">
    <h4 class="text-xl font-semibold text-green-700 mb-4">🛠️ Function</h4>
    <a href="{{ route('pool.function') }}"
       class="block px-4 py-4 bg-white rounded shadow-sm text-green-800 font-medium hover:bg-green-200 transition text-center">
        Xem danh sách Function
    </a>
</div>
                </div>
            </div>
        </div>
    </div>
@endsection
