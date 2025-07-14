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
        // Khởi tạo một query builder cho model Job
        $query = Job::query();

        // Kiểm tra nếu có từ khóa tìm kiếm được gửi từ request
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            // Thêm điều kiện lọc theo tên hoặc mô tả công việc chứa từ khóa tìm kiếm
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Lấy danh sách công ty, kèm theo đếm số lượng công việc liên quan đến mỗi công ty
        $companies = Company::withCount('jobs')->get();

        // Trả về view 'jobs.index' và truyền biến $companies cho view
        return view('jobs.index', compact('companies'));
    }


    public function uploadCv(Request $request, $jobId)
    {
        // ✅ VALIDATE dữ liệu gửi từ form
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048', // Bắt buộc có file, chỉ chấp nhận PDF/DOC/DOCX, tối đa 2MB
            'full_name' => 'required|string|max:255',       // Họ tên bắt buộc, tối đa 255 ký tự
            'birth_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'), // Năm sinh phải là số 4 chữ số, hợp lệ
            'last_company' => 'nullable|string|max:255',    // Công ty gần nhất (có thể bỏ qua)
            'last_position' => 'nullable|string|max:255',   // Vị trí gần nhất (có thể bỏ qua)
        ]);

        // ✅ LƯU FILE CV lên thư mục storage (disk 'public' => lưu vào storage/app/public/cvs)
        $file = $request->file('cv');
        $path = $file->store('cvs', 'public'); // Trả về đường dẫn tương đối như: cvs/abc123.pdf

        // ✅ TẠO BẢN GHI MỚI trong bảng `cvs` với thông tin ứng viên và đường dẫn file
        Cv::create([
            'user_id' => Auth::id(),             // ID người dùng hiện tại (đang đăng nhập)
            'job_id' => $jobId,                  // ID của công việc đang ứng tuyển
            'file_path' => $path,                // Đường dẫn file CV đã upload
            'full_name' => $request->full_name,  // Họ tên
            'birth_year' => $request->birth_year, // Năm sinh
            'last_company' => $request->last_company, // Công ty gần nhất
            'last_position' => $request->last_position, // Chức danh gần nhất
        ]);

        // ✅ CHUYỂN HƯỚNG về trang danh sách công việc kèm thông báo thành công
        return redirect()->route('jobs.index')->with('success', 'Tải CV thành công!');
    }

   public function store(Request $request)
{
    // ✅ BƯỚC 1: Validate dữ liệu đầu vào từ form
    $request->validate([
        'cv' => 'required|mimes:pdf,doc,docx|max:5120', // Bắt buộc có file, đúng định dạng, tối đa 5MB
        'job_id' => 'nullable|exists:jobs,id',           // job_id không bắt buộc, nếu có phải tồn tại trong bảng jobs
        'full_name' => 'required|string|max:255',        // Họ tên là bắt buộc
        'birth_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'), // Năm sinh hợp lệ
        'last_company' => 'nullable|string|max:255',     // Công ty trước đó (nếu có)
        'last_position' => 'nullable|string|max:255',    // Chức danh trước đó (nếu có)
    ]);

    // ✅ BƯỚC 2: Kiểm tra xem người dùng có upload file CV không
    if ($request->hasFile('cv')) {
        $file = $request->file('cv');

        // ✅ BƯỚC 3: Lưu file vào thư mục `storage/app/public/cvs`
        $path = $file->store('cvs', 'public');

        // ✅ BƯỚC 4: Tạo bản ghi mới trong bảng `cvs`
        Cv::create([
            'user_id' => Auth::id(),                         // Gán theo người dùng đang đăng nhập
            'job_id' => $request->job_id ?? null,            // Có thể null nếu người dùng chỉ upload CV chứ không apply job
            'file_path' => $path,                            // Đường dẫn tới file CV
            'full_name' => $request->full_name,
            'birth_year' => $request->birth_year,
            'last_company' => $request->last_company,
            'last_position' => $request->last_position,
        ]);

        // ✅ BƯỚC 5: Chuyển hướng sau khi upload thành công
        return redirect()->route('cv.index')->with('success', 'Tải CV thành công!');
    } else {
        // ❌ Trường hợp không có file nào được upload
        return redirect()->back()->with('error', 'Không có file được tải lên');
    }
}

    public function show($id)
{
    // ✅ TÌM công việc theo ID và LOAD kèm danh sách CV mà người dùng hiện tại đã nộp
    $job = Job::with([
        'cvs' => function ($query) {
            // Chỉ lấy các CV do người dùng hiện tại (đã đăng nhập) nộp cho công việc này
            // $query->where('user_id', auth()->id());
            $query->where('user_id', Auth::id());
        }
    ])->findOrFail($id); // Nếu không tìm thấy job => trả về lỗi 404
         if ($job->hand_count >= $job->vacancy && $job->status !== 'closed') {
        $job->status = 'closed';
        $job->save();
    }

    // ✅ TRUYỀN dữ liệu job (cùng CV của người dùng – nếu có) vào view `jobs.show`
    return view('jobs.show', compact('job'));
}
public function edit(Job $job)
{
    // Hiển thị form edit với dữ liệu job hiện tại
    return view('jobs.edit', compact('job'));
}

public function update(Request $request, Job $job)
{
    // Validate dữ liệu
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        // Thêm các trường khác nếu có
    ]);

    // Cập nhật dữ liệu
    $job->update([
        'title' => $request->title,
        'description' => $request->description,
        // Các trường khác
    ]);

    // Chuyển hướng về trang chi tiết hoặc danh sách với thông báo
    return redirect()->route('jobs.show', $job->id)
                     ->with('success', 'Công việc đã được cập nhật thành công!');
}


  public function create()
{
    // ✅ Lấy toàn bộ danh sách công ty từ DB để hiển thị trong form
    $companies = Company::all();

    // ✅ Truyền danh sách công ty vào view để hiển thị trong dropdown
    return view('jobs.create', compact('companies'));
}


    // Xử lý lưu công việc mới
   public function storeJob(Request $request)
{
    // ✅ BƯỚC 1: Validate dữ liệu từ form
    $validated = $request->validate([
        'title' => 'required|string|max:255',           // Tiêu đề là bắt buộc
        'description' => 'nullable|string',             // Mô tả có thể để trống
        'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        'company_id' => 'required|exists:companies,id', // Công ty phải tồn tại
        // 'status' => 'required|in:open,closed',
        'vacancy' => 'required|integer|min:1', // Số lượng tuyển dụng, tối thiểu 1
        'type' => 'required|in:manager,specialist',     // Loại job: quản lý / chuyên viên
    ]);

    // ✅ BƯỚC 2: Lưu dữ liệu vào DB
    Job::create([
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
        'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        'company_id' => $validated['company_id'],
        // 'status' => $validated['status'],\
        'vacancy' => $validated['vacancy'],
        'type' => $validated['type'],
    ]);

    // ✅ BƯỚC 3: Chuyển hướng về danh sách và thông báo thành công
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
    $isCmcCorp = $company->id == 1;
        return view('jobs.status', compact('isCmcCorp','company', 'managerJobs', 'specialistJobs', 'status'));
    }

    public function showOpen($companyId)
    {
        return $this->showJobsByStatus($companyId, 'open');
    }
    public function showClosed($companyId)
    {
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

    public function qualify(Cv $cv)
    {
        if (!$cv->qualified) {
            $cv->qualified = true;
            $cv->save();

            $cv->job()->increment('qualified_count');
            $cv->job->refresh();
        }

        return redirect()->back()->with('success', 'Ứng viên đã được đánh dấu là đủ điều kiện.');

    }
    public function markInterview1(Cv $cv)
    {
        if (!$cv->interview1) {
            $cv->interview1 = true;
            $cv->save();

            // Tăng số lượng phỏng vấn 1 cho job liên quan
            $cv->job()->increment('interview1_count');
        }

        return redirect()->back()->with('success', 'Ứng viên đã được đánh dấu là đã đến vòng phỏng vấn 1.');
    }

    public function markInterview2(Cv $cv)
    {
        if (!$cv->interview2) {
            $cv->interview2 = true;
            $cv->save();

            // Tăng số lượng ứng viên phỏng vấn 2 cho job liên quan
            $cv->job()->increment('interview2_count');
        }

        return redirect()->back()->with('success', 'Ứng viên đã được đánh dấu là đến vòng phỏng vấn 2.');
    }
    public function markOffer(Cv $cv)
    {
        if (!$cv->offer) {
            $cv->offer = true;
            $cv->save();

            $cv->job()->increment('offer_count');
        }

        return redirect()->back()->with('success', 'Ứng viên đã được đánh dấu là đã nhận Offer.');
    }

    public function markHand(Cv $cv)
    {
        if (!$cv->hand) {
            $cv->hand = true;
            $cv->save();

            $cv->job()->increment('hand_count');
        }

        return redirect()->back()->with('success', 'Ứng viên đã được đánh dấu là đã nhận việc.');
    }
    //  public function apply(Job $job)
    // {

    //     // Trả về view chứa form ứng tuyển, truyền biến $job sang view

    //     return view('jobs.apply', compact('job'));
    // }


}
