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

    // Lọc theo tháng
    if ($request->filled('month')) {
        $month = $request->input('month');
        $start = Carbon::parse($month . '-01')->startOfMonth();
        $end = Carbon::parse($month . '-01')->endOfMonth();

        $query->whereBetween('created_at', [$start, $end]);
    }

    // Lọc theo loại công việc: 'manager' hoặc 'staff'
    if ($request->filled('type')) {
        $query->where('type', $request->input('type'));
    }

    $jobs = $query->get();

    return view('jobs.statistics', compact('jobs'));
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
