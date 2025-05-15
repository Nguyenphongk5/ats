<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function index()
    {
         $cvs = Cv::with('job')->get();

    // Nhóm CV theo job_id, nếu job_id null thì nhóm vào 0
    $cvsGrouped = $cvs->groupBy(fn($cv) => $cv->job?->id ?? 0);

    return view('cv.index', compact('cvsGrouped'));
    }

    public function show($id)
    {
        $cv = Cv::with('job')->findOrFail($id);
        return view('cv.show', compact('cv'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cv' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }


        $file = $request->file('cv');
        $path = $file->store('cvs', 'public');

        Cv::create([
            'user_id' => Auth::id(),
            'job_id' => null, // Không cần chọn job
            'file_path' => $path,
        ]);

        return redirect()->route('cv.index')->with('success', 'Tải CV thành công!');
    }
}
