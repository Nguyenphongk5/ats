@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-green-700">Thêm mới Function</h2>

    <form action="{{ route('pool.function.store') }}" method="POST">
        @csrf

        <label class="block mb-2">Tên chức năng</label>
        <input name="name" required class="w-full mb-4 border rounded px-3 py-2" placeholder="VD: Tài chính">

        <label class="block mb-2">Mô tả</label>
        <textarea name="description" class="w-full mb-4 border rounded px-3 py-2"></textarea>

        <label class="block mb-2">Trạng thái</label>
        <select name="status" class="w-full mb-4 border rounded px-3 py-2">
            <option value="active">Đang hoạt động</option>
            <option value="inactive">Ngưng hoạt động</option>
        </select>

        <button class="w-full bg-green-600 text-white py-2 rounded">Thêm mới</button>
    </form>
</div>
@endsection
