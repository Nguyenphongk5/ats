<?php
namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Job;
use App\Models\Applicant; // hoặc model tương ứng
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cvs' => Cv::count(),
            'total_jobs' => Job::count(),
            'total_applicants' => User::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
