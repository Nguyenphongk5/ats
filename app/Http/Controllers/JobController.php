<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
    $companies = Company::withCount('jobs')->get();

        return view('jobs.index', compact('companies'));
}

    public function uploadCv(Request $request, $jobId)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            'full_name' => 'required|string|max:255',
            'birth_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'last_company' => 'nullable|string|max:255',
            'last_position' => 'nullable|string|max:255',
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'public');

        Cv::create([
            'user_id' => Auth::id(),
    'job_id' => $jobId,
    'file_path' => $path,
    'full_name' => $request->full_name,
    'birth_year' => $request->birth_year,
    'last_company' => $request->last_company,
    'last_position' => $request->last_position,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Tải CV thành công!');
    }
    public function store(Request $request)
{
    // Validate file và job_id (nếu có)
    $request->validate([
        'cv' => 'required|mimes:pdf,doc,docx|max:5120',
    'job_id' => 'nullable|exists:jobs,id',
    'full_name' => 'required|string|max:255',
    'birth_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
    'last_company' => 'nullable|string|max:255',
    'last_position' => 'nullable|string|max:255',
    ]);

    // Kiểm tra nếu file đã được upload
    if ($request->hasFile('cv')) {
        $file = $request->file('cv');

        // Lưu file vào thư mục public/cvs
        $path = $file->store('cvs', 'public');

        // Nếu có job_id thì liên kết CV với job, nếu không thì không
        Cv::create([
            'user_id' => Auth::id(),
            'job_id' => $request->job_id ?? null,
            'file_path' => $path,
            'full_name' => $request->full_name,
            'birth_year' => $request->birth_year,
            'last_company' => $request->last_company,
            'last_position' => $request->last_position,
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
      $companies = Company::all(); // Lấy danh sách công ty để chọn
    return view('jobs.create', compact('companies'));
    }

    // Xử lý lưu công việc mới
    public function storeJob(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'company_id' => 'required|exists:companies,id',
        'status' => 'required|in:open,closed',
        'type' => 'required|in:manager,specialist',
    ]);

    Job::create([
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
        'start_date' => $validated['start_date'],
        'company_id' => $validated['company_id'],
        'status' => $validated['status'],
        'type' => $validated['type'],
    ]);


    return redirect()->route('jobs.index')->with('success', 'Thêm công việc thành công!');
}

    public function jobsByCompany($companyId)
{
    $jobs = Job::where('company_id', $companyId)
        ->orderByRaw("CASE WHEN status = 'open' THEN 1 ELSE 0 END DESC")
        ->orderBy('start_date', 'desc')
        ->get();

    $company = Company::findOrFail($companyId);

    $openJobs = $jobs->where('status', 'open');
    $closedJobs = $jobs->where('status', 'closed');

    return view('jobs.by_company', compact('company', 'openJobs', 'closedJobs'));
}


    public function openJobs(Company $company)
    {
        // Lấy danh sách job đang mở, truyền qua view
        $openJobs = $company->jobs()->where('status', 'open')->get();

        return view('jobs.open', compact('company', 'openJobs'));
    }

    public function closedJobs(Company $company)
    {
        // Lấy danh sách job đã đóng
        $closedJobs = $company->jobs()->where('status', 'closed')->get();

        return view('jobs.closed', compact('company', 'closedJobs'));
    }

public function showOpenJobs(Company $company)
{
    $managerJobs = $company->jobs()->where('status', 'open')->where('type', 'manager')->get();
    $specialistJobs = $company->jobs()->where('status', 'open')->where('type', 'specialist')->get();

    return view('jobs.status', [
        'company' => $company,
        'status' => 'open',
        'managerJobs' => $managerJobs,
        'specialistJobs' => $specialistJobs
    ]);
}

public function showClosedJobs(Company $company)
{
    $managerJobs = $company->jobs()->where('status', 'closed')->where('type', 'manager')->get();
    $specialistJobs = $company->jobs()->where('status', 'closed')->where('type', 'specialist')->get();

    return view('jobs.status', [
        'company' => $company,
        'status' => 'closed',
        'managerJobs' => $managerJobs,
        'specialistJobs' => $specialistJobs
    ]);
}

public function showJobsByStatus($companyId, $status)
{
    $company = Company::findOrFail($companyId);

    $managerJobs = Job::where('company_id', $companyId)
        ->where('status', $status)
        ->where('type', 'manager') // sửa position -> type
        ->get();

    $specialistJobs = Job::where('company_id', $companyId)
        ->where('status', $status)
        ->where('type', 'specialist') // sửa position -> type
        ->get();

    return view('jobs.status', compact('company', 'managerJobs', 'specialistJobs', 'status'));
}

public function showOpen($companyId) {
    return $this->showJobsByStatus($companyId, 'open');
}
public function showClosed($companyId) {
    return $this->showJobsByStatus($companyId, 'closed');
}

public function showCompanies()
{
    $companies = Company::withCount('jobs')->get(); // <-- cần có dòng này
    return view('your_view_name', compact('companies'));
}

public function showApplyForm($jobId)
{
    $job = Job::findOrFail($jobId);
    return view('jobs.apply', compact('job'));
}





}
