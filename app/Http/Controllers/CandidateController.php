<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cv;
use Carbon\Carbon;

class CandidateController extends Controller
{
    // Trang hiển thị danh sách và biểu đồ
    public function index(Request $request)
    {
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

        for ($i = 0; $i < 19; $i++) {
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

        return view('candidates.index', compact('candidates', 'chartData', 'filterMonth'));
    }
}
