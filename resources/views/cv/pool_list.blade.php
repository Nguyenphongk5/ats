@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-bold mb-4 text-indigo-700">
        📋 Danh sách CV ứng tuyển vào Pool: {{ $cxo->position }}
    </h2>

    @if ($cvs->isEmpty())
        <p class="text-gray-500">Chưa có ứng viên nào nộp CV vào Pool này.</p>
    @else
        <table class="table-auto w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Họ tên</th>
                    <th class="px-4 py-2 border">Năm sinh</th>
                    <th class="px-4 py-2 border">Công ty gần nhất</th>
                    <th class="px-4 py-2 border">Chức danh</th>
                    <th class="px-4 py-2 border">CV</th>
                    <th class="px-4 py-2 border">Nộp lúc</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cvs as $index => $cv)
                    <tr>
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $cv->full_name }}</td>
                        <td class="px-4 py-2 border">{{ $cv->birth_year }}</td>
                        <td class="px-4 py-2 border">{{ $cv->last_company }}</td>
                        <td class="px-4 py-2 border">{{ $cv->last_position }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank" class="text-blue-600 underline">Xem CV</a>
                        </td>
                        <td class="px-4 py-2 border">{{ $cv->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
