<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobStatisticController extends Controller
{
    //
    public function index(Request $request)
{
    $query = Job::with('cvs');

    // Lọc tháng hoặc loại nếu có
    if ($request->filled('month')) {
        $month = $request->input('month');
        $start = Carbon::parse($month . '-01')->startOfMonth();
        $end = Carbon::parse($month . '-01')->endOfMonth();
        $query->whereBetween('created_at', [$start, $end]);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->input('type'));
    }

    $jobs = $query->get();

    // Hàm check đúng hạn/chậm
    $isOnTime = function($job, $cv) {
        $threshold = $job->type === 'manager' ? 60 : 45;
        $daysDiff = $job->created_at->diffInDays($cv->offer_date);
        return $daysDiff <= $threshold;
    };

    $isLate = function($job, $cv) {
        $threshold = $job->type === 'manager' ? 60 : 45;
        $daysDiff = $job->created_at->diffInDays($cv->offer_date);
        return $daysDiff > $threshold;
    };

    // Đếm số lượng
    $countOnTime = $jobs->filter(function($job) use ($isOnTime) {
        // Có ít nhất 1 CV được offer đúng hạn
        return $job->cvs->whereNotNull('offer_date')->contains(function($cv) use ($job, $isOnTime) {
            return $isOnTime($job, $cv);
        });
    })->count();

    $countLate = $jobs->filter(function($job) use ($isLate) {
        // Có ít nhất 1 CV được offer chậm
        return $job->cvs->whereNotNull('offer_date')->contains(function($cv) use ($job, $isLate) {
            return $isLate($job, $cv);
        });
    })->count();

    $countProcessing = $jobs->filter(function($job) {
        // Chưa có CV nào offer (offer_date null hoặc chưa có CV)
        return $job->cvs->whereNotNull('offer_date')->isEmpty();
    })->count();

    // Lọc theo trạng thái nếu có param
    if ($request->filled('status')) {
        $status = $request->input('status');

        $jobs = $jobs->filter(function($job) use ($status, $isOnTime, $isLate) {
            $offerCVs = $job->cvs->whereNotNull('offer_date');

            if ($status === 'on_time') {
                return $offerCVs->contains(function($cv) use ($job, $isOnTime) {
                    return $isOnTime($job, $cv);
                });
            } elseif ($status === 'late') {
                return $offerCVs->contains(function($cv) use ($job, $isLate) {
                    return $isLate($job, $cv);
                });
            } elseif ($status === 'processing') {
                return $offerCVs->isEmpty();
            }

            return true;
        })->values();
    }

    return view('jobs.statistics', compact('jobs', 'countOnTime', 'countLate', 'countProcessing'));
}

    // JobController hoặc controller tương ứng

public function showStatistics()
{
    $jobs = Job::with(['cvs' => function ($query) {
        $query->whereNotNull('offer_date')->orderBy('offer_date');
    }])->get();

    return view('jobs.statistics', compact('jobs'));
}

}
