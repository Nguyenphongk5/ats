<?php

namespace App\Http\Controllers;

use App\Models\Cxo;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    //
        public function index()
    {
        $cxos = Cxo::all();
    // $functions = FunctionModel::all();

    return view('pool.index', compact('cxos'));
    }
    public function functionList()
{
    // Fake dữ liệu mẫu: 2 cột quản lý và nhân viên
    $managers = ['Trưởng phòng', 'Giám sát', 'Quản lý dự án'];
    $staffs = ['Nhân viên IT', 'Nhân viên Marketing', 'Nhân viên Kinh doanh'];

    return view('pool.function', compact('managers', 'staffs'));
}

}
