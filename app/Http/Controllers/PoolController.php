<?php

namespace App\Http\Controllers;

use App\Models\Cxo;
use App\Models\FunctionModel;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    //
  public function index()
{
    $cxos = CxO::all();
    $functions = FunctionModel::all(); // lấy toàn bộ dữ liệu

    return view('pool.index', compact('cxos', 'functions'));
}
    // public function functionList()
    // {
    //     // Fake dữ liệu mẫu: 2 cột quản lý và nhân viên
    //     $managers = ['Trưởng phòng', 'Giám sát', 'Quản lý dự án'];
    //     $staffs = ['Nhân viên IT', 'Nhân viên Marketing', 'Nhân viên Kinh doanh'];

    //     return view('pool.function', compact('managers', 'staffs'));
    // }
    public function showCxo($id)
    {
        $cxo = Cxo::with('jobs')->findOrFail($id);
        return view('pool.show', compact('cxo'));
    }
    public function createCxo()
    {
        return view('pool.create'); // view form tạo mới CxO
    }
    public function storeCxo(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
        ]);

        Cxo::create([
            'position' => $request->position,
        ]);

        return redirect()->route('pool.index')->with('success', 'Thêm CxO thành công!');
    }

//   public function functionList()
// {
//     $functions = FunctionModel::all(); // Lấy toàn bộ function từ DB

//     return view('pool.function', compact('functions')); // Truyền $functions sang view
// }
}
