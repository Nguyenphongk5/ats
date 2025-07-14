<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\CvNote;
use App\Models\Cxo;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
   public function index(Request $request)
{
    $jobId = $request->input('job_id');

    $cvsQuery = Cv::with(['job', 'cxo', 'function'])->orderBy('created_at', 'desc');

    if (!empty($jobId)) {
        if (str_starts_with($jobId, 'pool_')) {
            $cxoId = str_replace('pool_', '', $jobId);
            $cvsQuery->where('cxo_id', $cxoId)->whereNull('job_id');
        } elseif (str_starts_with($jobId, 'function_')) {
            $functionId = str_replace('function_', '', $jobId);
            $cvsQuery->where('function_id', $functionId)->whereNull('job_id');
        } else {
            $cvsQuery->where('job_id', $jobId);
        }
    }

    $cvs = $cvsQuery->paginate(12); // Phân trang tại đây

    $jobs = Job::orderBy('title')->get();
    $cxos = Cxo::orderBy('position')->get();
    $functions = \App\Models\FunctionModel::orderBy('name')->get();

    return view('cv.index', compact('cvs', 'jobs', 'cxos', 'functions', 'jobId'));
}


    public function listByJob($jobId)
{
    $cvs = Cv::with('job')
        ->where('job_id', $jobId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('cv.list_by_job', compact('cvs'));
}
    public function indexByJob(Job $job)
{
    // Lấy danh sách CV theo công việc đó
    $cvsGrouped = collect([$job->id => $job->cvs]);
$jobs = Job::orderBy('title')->get();
$jobId = $job->id;
 $cvs = $job->cvs;
$cvs = Cv::where('job_id', $jobId)->paginate(10); // ✅ paginate()

return view('cv.index', compact('cvs','cvsGrouped', 'jobs', 'jobId'));

}
// public function create(Request $request)
// {
//     $jobId = $request->job_id;
//     $cxoId = $request->cxo_id;

//     return view('cv.create', compact('jobId', 'cxoId'));
// }

   public function show($id)
{
    $cv = Cv::with(['job', 'cxo'])->findOrFail($id); // Lấy CV theo ID, kèm job và cxo liên quan

    return view('cv.show', compact('cv')); // Truyền biến $cv sang view
}


    public function applyForm($jobId)
    {
        $job = Job::findOrFail($jobId);

        return view('jobs.apply', compact('job',));
    }


    public function submitApplication(Request $request, $jobId, )
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_year' => 'required|integer|between:1900,2100',
            'last_company' => 'nullable|string|max:255',
            'last_position' => 'nullable|string|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $job = Job::findOrFail($jobId);


        $filePath = $request->file('cv')->store('cvs', 'public');

        Cv::create([
            'job_id' => $job->id,

            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'birth_year' => $request->birth_year,
            'last_company' => $request->last_company,
            'last_position' => $request->last_position,
            'file_path' => $filePath,
        ]);

        return redirect()->route('cv.index')->with('success', 'Nộp đơn thành công!');
    }

    public function listCVs()
    {
        $cvs = Cv::with('job')->orderBy('created_at', 'desc')->get();
        $cvsGrouped = $cvs->groupBy('job_id');

        return view('cv.index', compact('cvsGrouped',));
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

    // Cập nhật ngày qualify và tăng qualified_count
    public function qualify(Request $request, Cv $cv)
    {
        $request->validate([
            'qualify_date' => 'required|date',
        ]);

        $cv->qualify_date = $request->input('qualify_date');
        $cv->save();

        if (!$cv->qualified) {
            $cv->qualified = true;
            $cv->save();

            // Chỉ tăng count nếu CV thuộc job
            if ($cv->job) {
                $cv->job->increment('qualified_count');
                $cv->job->refresh();
            }
        }

        return redirect()->back()->with('success', 'Ứng viên đã được đánh dấu là đủ điều kiện.');
    }

    // Cập nhật ngày interview1 và tăng interview1_count
    public function markInterview1(Request $request, Cv $cv)
    {
        $request->validate([
            'interview1_date' => 'required|date',
        ]);

        $cv->interview1_date = $request->input('interview1_date');
        $cv->save();


        if (!$cv->interview1) {
            $cv->interview1 = true;
            $cv->save();

            // Chỉ tăng count nếu CV thuộc job
            if ($cv->job) {
                $cv->job->increment('interview1_count');
                $cv->job->refresh();
            }
        }

        return redirect()->back()->with('success', 'Đã cập nhật ngày phỏng vấn 1 và tăng số lượng.');
    }

    // Cập nhật ngày interview2 và tăng interview2_count
    public function markInterview2(Request $request, Cv $cv)
    {
        $request->validate([
            'interview2_date' => 'required|date',
        ]);

        $cv->interview2_date = $request->input('interview2_date');
        $cv->save();

        if (!$cv->interview2) {
            $cv->interview2 = true;
            $cv->save();

            // Chỉ tăng count nếu CV thuộc job
            if ($cv->job) {
                $cv->job->increment('interview2_count');
                $cv->job->refresh();
            }
        }

        return redirect()->back()->with('success', 'Đã cập nhật ngày phỏng vấn 2 và tăng số lượng.');
    }

    // Cập nhật ngày offer và tăng offer_count
    public function markOffer(Request $request, Cv $cv)
    {
        $request->validate([
            'offer_date' => 'required|date',
        ]);

        $cv->offer_date = $request->input('offer_date');
        $cv->save();

        if (!$cv->offer) {
            $cv->offer = true;
            $cv->save();

            // Chỉ tăng count nếu CV thuộc job
            if ($cv->job) {
                $cv->job->increment('offer_count');
                $cv->job->refresh();
            }
        }

        return redirect()->back()->with('success', 'Đã cập nhật ngày nhận offer và tăng số lượng.');
    }

    // Cập nhật ngày hand và tăng hand_count
    public function markHand(Request $request, Cv $cv)
    {
        $request->validate([
            'hand_date' => 'required|date',
        ]);

        $cv->hand_date = $request->input('hand_date');
        $cv->save();

        if (!$cv->hand) {
            $cv->hand = true;
            $cv->save();

            // Chỉ tăng count nếu CV thuộc job
            if ($cv->job) {
                $cv->job->increment('hand_count');
                $cv->job->refresh();
            }
        }

        return redirect()->back()->with('success', 'Đã cập nhật ngày nhận việc và tăng số lượng.');
    }

   public function status()
{
 $cvs = Cv::select('id','full_name', 'created_at', 'qualify_date', 'interview1_date', 'interview2_date', 'offer_date', 'hand_date')->paginate(10);


    return view('cv.status', compact('cvs'));
}

    public function applyForPool($cxoId)
{
    $cxo = Cxo::findOrFail($cxoId);
    return view('cv.apply_pool', compact('cxo'));
}

// Xử lý submit CV cho Pool
public function submitForPool(Request $request, $cxoId)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'birth_year' => 'required|integer|between:1900,2100',
        'last_company' => 'nullable|string|max:255',
        'last_position' => 'nullable|string|max:255',
        'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $cxo = Cxo::findOrFail($cxoId);
    $filePath = $request->file('cv')->store('cvs', 'public');

    Cv::create([
        'job_id' => null, // KHÔNG gắn job
        'cxo_id' => $cxo->id,
        'user_id' => Auth::id(),
        'full_name' => $request->full_name,
        'birth_year' => $request->birth_year,
        'last_company' => $request->last_company,
        'last_position' => $request->last_position,
        'file_path' => $filePath,
    ]);

    return redirect()->route('pool.cvs', ['cxoId' => $cxo->id])->with('success', 'Nộp CV vào Pool thành công!');
}
    public function listPoolCvs($cxoId)
{
    $cxo = \App\Models\Cxo::findOrFail($cxoId);

    $cvs = Cv::where('cxo_id', $cxo->id)
             ->whereNull('job_id') // Chỉ lấy CV không gắn Job
             ->orderBy('created_at', 'desc')
             ->get();

    return view('cv.list_pool', compact('cxo', 'cvs'));
}
    public function updateApply(Request $request, Cv $cv)
{
    $request->validate([
        'created_at' => 'required|date',
    ]);

    $cv->created_at = $request->created_at;
    $cv->save();

    return back()->with('success', 'Ngày Apply đã được cập nhật.');
}
public function listFunctionCvs($functionId)
{
    $function = \App\Models\FunctionModel::findOrFail($functionId);

    $cvs = Cv::where('function_id', $function->id)
             ->whereNull('job_id') // Chỉ lấy CV không gắn Job
             ->orderBy('created_at', 'desc')
             ->get();

    return view('cv.list_function', compact('function', 'cvs'));
}


}
