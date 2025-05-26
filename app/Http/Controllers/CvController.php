<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\CvNote;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::with('job')->orderBy('created_at', 'desc')->get();
        $cvsGrouped = $cvs->groupBy('job_id');

        return view('cv.index', compact('cvsGrouped'));
    }

    // Hiển thị form nộp đơn ứng tuyển
    public function applyForm($jobId)
    {
        $job = Job::findOrFail($jobId);
        return view('jobs.apply', compact('job'));
    }

    // Xử lý submit đơn ứng tuyển
    public function submitApplication(Request $request, $jobId)
    {
        $request->validate([
           'full_name' => 'required|string|max:255',
    'birth_year' => 'required|integer|between:1900,2100',
    'last_company' => 'nullable|string|max:255',
    'last_position' => 'nullable|string|max:255',
    'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $job = Job::findOrFail($jobId);

        // Lưu file CV lên storage/app/public/cvs
        $filePath = $request->file('cv')->store('cvs', 'public');

        // Tạo record CV
        Cv::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(), // thêm dòng này
            'full_name' => $request->full_name,
            'birth_year' => $request->birth_year,
            'last_company' => $request->last_company,
            'last_position' => $request->last_position,
            'file_path' => $filePath,
        ]);

        return redirect()->route('cv.index')->with('success', 'Nộp đơn thành công!');
    }

    // Hiển thị danh sách CV đã nộp
    public function listCVs()
    {
        $cvs = Cv::with('job')->orderBy('created_at', 'desc')->get();

        // Nhóm theo job_id
        $cvsGrouped = $cvs->groupBy('job_id');

        return view('cv.index', compact('cvsGrouped'));
    }
    public function view($id)
{
    $cv = Cv::findOrFail($id);
    return view('cv.view', compact('cv'));
}

public function saveNote(Request $request, $id)
{
    $request->validate([
        'note' => 'required|string|max:1000',
    ]);

    CvNote::create([
        'cv_id' => $id,
        'note' => $request->note,
    ]);

    return back()->with('success', 'Ghi chú đã được lưu.');
}


 public function qualify(Cv $cv)
{
    if (!$cv->qualified) {
        $cv->qualified = true;
        $cv->save();

        // Tăng qualified_count ở job tương ứng
        $cv->job->increment('qualified_count');  // dùng quan hệ job
        $cv->job->refresh(); // load lại dữ liệu mới
    }

    return response()->json([
        'success' => true,
        'qualifiedCount' => $cv->job->qualified_count
    ]);
}
  
}

