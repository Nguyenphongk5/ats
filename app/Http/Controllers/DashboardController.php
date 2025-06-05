<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Job;
use App\Models\Applicant; // hoặc model tương ứng
use App\Models\User;
use Illuminate\Http\Request;


use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'total_cvs' => Cv::count(),
            'total_jobs' => Job::count(),
            'total_applicants' => User::count(),
        ];
        $totalJobs = Job::count();
        $openJobs = Job::where('status', 'open')->count();
        $percentOpen = $totalJobs > 0 ? ($openJobs / $totalJobs) * 100 : 0;
 $closedJobs = Job::where('status', 'closed')->count(); // hoặc 'inactive', tuỳ hệ thống của bạn

    $percentClosed = $totalJobs > 0 ? ($closedJobs / $totalJobs) * 100 : 0;

        $filterMonth = $request->input('month');

        $query = Cv::query();

        if ($filterMonth) {
            $query->whereYear('created_at', substr($filterMonth, 0, 4))
                ->whereMonth('created_at', substr($filterMonth, 5, 2));
        }

        $candidates = $query->orderBy('created_at', 'desc')->get();

        // Chuẩn bị dữ liệu biểu đồ theo từng mốc (12 tháng gần nhất)
        $startDate = now()->subMonths(11)->startOfMonth();

        $labels = [];
        $apply = [];
        $qualify = [];
        $interview1 = [];
        $interview2 = [];
        $offer = [];
        $hand = [];

        for ($i = 6; $i < 18; $i++) {
            $month = $startDate->copy()->addMonths($i)->format('Y-m');

            $labels[] = $month;

            $apply[] = Cv::whereYear('created_at', substr($month, 0, 4))
                ->whereMonth('created_at', substr($month, 5, 2))
                ->count();

            $qualify[] = Cv::whereYear('qualify_date', substr($month, 0, 4))
                ->whereMonth('qualify_date', substr($month, 5, 2))
                ->count();

            $interview1[] = Cv::whereYear('interview1_date', substr($month, 0, 4))
                ->whereMonth('interview1_date', substr($month, 5, 2))
                ->count();

            $interview2[] = Cv::whereYear('interview2_date', substr($month, 0, 4))
                ->whereMonth('interview2_date', substr($month, 5, 2))
                ->count();

            $offer[] = Cv::whereYear('offer_date', substr($month, 0, 4))
                ->whereMonth('offer_date', substr($month, 5, 2))
                ->count();

            $hand[] = Cv::whereYear('hand_date', substr($month, 0, 4))
                ->whereMonth('hand_date', substr($month, 5, 2))
                ->count();
        }

        $chartData = [
            'labels' => $labels,
            'apply' => $apply,
            'qualify' => $qualify,
            'interview1' => $interview1,
            'interview2' => $interview2,
            'offer' => $offer,
            'hand' => $hand,
        ];
        return view('dashboard', compact('stats', 'percentOpen', 'chartData', 'filterMonth','percentClosed'));
    }
}
