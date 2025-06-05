@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-700">📋 Các Job của CxO: {{ $cxo->position }}</h2>

    @forelse ($cxo->jobs as $job)
    <div
        class="job-card border rounded p-4 mb-5 shadow-sm bg-[#fafafa] cursor-pointer"
        data-fulltext="{{ e($job->description) }}"
        data-shorttext="{{ e(\Illuminate\Support\Str::limit($job->description, 150, '...')) }}"
    >
        <strong>Mô tả:</strong>
        <div class="job-description" style="white-space: pre-line; margin-top: 0.25rem;">
            {{ \Illuminate\Support\Str::limit($job->description, 150, '...') }}
        </div>

        <p class="text-sm mt-3 text-gray-600"><strong>Trạng thái:</strong> {{ ucfirst($job->status) }}</p>


    </div>
       <div class="mt-4 space-x-3">
            <a href="#" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">+ Add CV</a>
            <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">List CV</a>
        </div>
    @empty
        <p class="text-gray-600 text-center">Chưa có công việc nào được tạo cho CxO này.</p>
    @endforelse
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.job-card').forEach(card => {
        card.addEventListener('click', function () {
            const descDiv = this.querySelector('.job-description');
            const fullText = this.getAttribute('data-fulltext');
            const shortText = this.getAttribute('data-shorttext');

            if (descDiv.textContent === shortText) {
                descDiv.textContent = fullText;
            } else {
                descDiv.textContent = shortText;
            }
        });
    });
});
</script>
@endpush
