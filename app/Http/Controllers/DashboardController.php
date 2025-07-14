<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(Request $request)
{
  $startMonth = $request->input('start_month'); // YYYY-MM
$endMonth = $request->input('end_month');     // YYYY-MM
$filterJobId = $request->input('job_id');

$labels = $apply = $qualify = $interview1 = $interview2 = $offer = $hand = [];

if ($startMonth && $endMonth) {
    $startDate = \Carbon\Carbon::parse($startMonth)->startOfMonth();
    $endDate = \Carbon\Carbon::parse($endMonth)->endOfMonth();

    while ($startDate <= $endDate) {
        $month = $startDate->format('Y-m');
        $labels[] = $month;

        $baseQuery = Cv::whereYear('created_at', $startDate->year)
                       ->whereMonth('created_at', $startDate->month);

        if ($filterJobId) $baseQuery->where('job_id', $filterJobId);
        $apply[] = (clone $baseQuery)->count();

        foreach (['qualify', 'interview1', 'interview2', 'offer', 'hand'] as $stage) {
            ${$stage}[] = Cv::whereYear("{$stage}_date", $startDate->year)
                            ->whereMonth("{$stage}_date", $startDate->month)
                            ->when($filterJobId, fn($q) => $q->where('job_id', $filterJobId))
                            ->count();
        }

        $startDate->addMonth();
    }
} else {
    // fallback: mặc định 12 tháng gần nhất
    $startDate = now()->subMonths(11)->startOfMonth();
    for ($i = 6; $i < 18; $i++) {
        $month = $startDate->copy()->addMonths($i)->format('Y-m');
        $labels[] = $month;

        $baseQuery = Cv::whereYear('created_at', substr($month, 0, 4))
                       ->whereMonth('created_at', substr($month, 5, 2));
        if ($filterJobId) $baseQuery->where('job_id', $filterJobId);
        $apply[] = (clone $baseQuery)->count();

        foreach (['qualify', 'interview1', 'interview2', 'offer', 'hand'] as $stage) {
            ${$stage}[] = Cv::whereYear("{$stage}_date", substr($month, 0, 4))
                            ->whereMonth("{$stage}_date", substr($month, 5, 2))
                            ->when($filterJobId, fn($q) => $q->where('job_id', $filterJobId))
                            ->count();
        }
    }
}

    $chartData = compact('labels', 'apply', 'qualify', 'interview1', 'interview2', 'offer', 'hand');

    // Biểu đồ phễu giữ nguyên
    $funnelQuery = Cv::query()->when($filterJobId, fn($q) => $q->where('job_id', $filterJobId));
    $funnelData = [
        'Apply'       => (clone $funnelQuery)->whereNotNull('created_at')->count(),
        'Qualify'     => (clone $funnelQuery)->whereNotNull('qualify_date')->count(),
        'Interview 1' => (clone $funnelQuery)->whereNotNull('interview1_date')->count(),
        'Interview 2' => (clone $funnelQuery)->whereNotNull('interview2_date')->count(),
        'Offer'       => (clone $funnelQuery)->whereNotNull('offer_date')->count(),
        'Onboard'     => (clone $funnelQuery)->whereNotNull('hand_date')->count(),
    ];

    $jobs = Job::select('id', 'title')->orderBy('title')->get();

    // Các số liệu thống kê tổng quan
    $stats = [
        'total_cvs' => Cv::count(),
        'total_jobs' => Job::count(),
        'total_applicants' => User::count(),
    ];
    $totalJobs = $stats['total_jobs'];
    $openJobs = Job::where('status', 'open')->count();
    $closedJobs = Job::where('status', 'closed')->count();
    $percentOpen = $totalJobs ? ($openJobs / $totalJobs) * 100 : 0;
    $percentClosed = $totalJobs ? ($closedJobs / $totalJobs) * 100 : 0;

    return view('dashboard', compact(
        'stats', 'percentOpen', 'percentClosed', 'chartData',
        'funnelData', 'jobs', 'startMonth', 'endMonth', 'filterJobId'
    ));
}

    public function funnel(Request $request)
    {
        $jobId = $request->input('job_id');

        $funnelQuery = Cv::query()->when($jobId, fn($q) => $q->where('job_id', $jobId));

        $funnelData = [
            'Apply'       => (clone $funnelQuery)->whereNotNull('created_at')->count(),
            'Qualify'     => (clone $funnelQuery)->whereNotNull('qualify_date')->count(),
            'Interview 1' => (clone $funnelQuery)->whereNotNull('interview1_date')->count(),
            'Interview 2' => (clone $funnelQuery)->whereNotNull('interview2_date')->count(),
            'Offer'       => (clone $funnelQuery)->whereNotNull('offer_date')->count(),
            'Onboard'     => (clone $funnelQuery)->whereNotNull('hand_date')->count(),
        ];

        return response()->json($funnelData);
    }
}
