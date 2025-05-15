<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
 public function index(Request $request)
{
    $query = Job::query();

    // Kiểm tra nếu có từ khóa tìm kiếm
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    // Lấy danh sách công việc
    $jobs = $query->latest()->get();

    return view('jobs.index', compact('jobs'));
}

    public function uploadCv(Request $request, $jobId)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'public');

        Cv::create([
            'user_id' => Auth::id(),
            'job_id' => $jobId,
            'file_path' => $path,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Tải CV thành công!');
    }
    public function store(Request $request)
{
    // Validate file và job_id (nếu có)
    $request->validate([
        'cv' => 'required|mimes:pdf,doc,docx|max:5120',
        'job_id' => 'nullable|exists:jobs,id',  // Kiểm tra job_id nếu có
    ]);

    // Kiểm tra nếu file đã được upload
    if ($request->hasFile('cv')) {
        $file = $request->file('cv');

        // Lưu file vào thư mục public/cvs
        $path = $file->store('cvs', 'public');

        // Nếu có job_id thì liên kết CV với job, nếu không thì không
        Cv::create([
            'user_id' => Auth::id(),
            'job_id' => $request->job_id ?? null,  // Nếu không có job_id thì null
            'file_path' => $path,
        ]);

        return redirect()->route('cv.index')->with('success', 'Tải CV thành công!');
    } else {
        return redirect()->back()->with('error', 'Không có file được tải lên');
    }
}
    public function show($id)
{
    $job = Job::with(['cvs' => function($query) {
        $query->where('user_id', auth()->id());
    }])->findOrFail($id);

    return view('jobs.show', compact('job'));
}
public function create()
    {
        return view('jobs.create');  // tạo view jobs/create.blade.php chứa form thêm job
    }

    // Xử lý lưu công việc mới
    public function storeJob(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'open_date' => 'required|date',
            'close_date' => 'required|date|after_or_equal:open_date',
        ], [
            'close_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
        ]);

        Job::create([
            'name' => $request->name,
            'description' => $request->description,
            'open_date' => $request->open_date,
            'close_date' => $request->close_date,
          'user_id' => Auth::id(),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Thêm công việc mới thành công!');
    }




}
