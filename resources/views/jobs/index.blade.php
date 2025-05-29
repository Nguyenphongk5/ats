@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-3xl font-bold text-gray-900">📝 Chọn công ty để xem Job</h3>

                <!-- ✅ Nút Thêm việc làm đã làm đẹp -->
                <a href="{{ route('jobs.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-full shadow transition duration-200">
                    <i class="bi bi-plus-circle"></i> Thêm việc làm
                </a>
            </div>

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

{{-- @push('scripts')
<script>
    // Code JS của bạn ở đây
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.qualify-btn').forEach(button => {
        button.addEventListener('click', function () {
            const cvId = this.dataset.cvId;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/cvs/${cvId}/qualify`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.disabled = true;
                    alert('Đã đánh dấu qualify!');

                    // Nếu muốn update số lượng qualified trên trang job:
                    // Ví dụ bạn có 1 span hiển thị số lượng, thì update nó ở đây
                    // document.querySelector('#qualifiedCountSpan').textContent = data.qualifiedCount;
                } else {
                    alert('Có lỗi xảy ra, thử lại!');
                }
            })
            .catch(() => alert('Lỗi kết nối!'));
        });
    });
});

</script>
@endpush --}}
