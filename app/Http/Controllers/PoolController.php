<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Cxo;
use App\Models\FunctionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoolController extends Controller
{
    public function index()
    {
        $cxos = Cxo::all();
        $functions = FunctionModel::all();
        return view('pool.index', compact('cxos', 'functions'));
    }

    public function showCxo($id)
    {
        $cxo = Cxo::with('jobs')->findOrFail($id);
        return view('pool.show', compact('cxo'));
    }

    public function createCxo()
    {
        return view('pool.create');
    }

    public function storeCxo(Request $request)
    {
 $request->validate([
    'position' => 'required|string|max:255',
    'description' => 'nullable|string',
    'status' => 'required|in:active,inactive',
]);


    Cxo::create([
    'position' => $request->position,
    'description' => $request->description,
    'status' => $request->status,
]);


        return redirect()->route('pool.index')->with('success', 'Thêm CxO thành công!');
    }

    public function applyForPool($cxoId)
    {
        $cxo = Cxo::findOrFail($cxoId);
        return view('cv.apply_pool', compact('cxo'));
    }

    public function submitForPool(Request $request, $cxoId)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'birth_year' => 'required|integer|between:1900,2100',
        'last_company' => 'nullable|string|max:255',
        'last_position' => 'nullable|string|max:255',
        'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $cxo = Cxo::findOrFail($cxoId);
    $filePath = $request->file('cv')->store('cvs', 'public');

    Cv::create([
        'job_id' => null,
        'cxo_id' => $cxo->id,
        'user_id' => Auth::id(),
        'full_name' => $request->full_name,
        'birth_year' => $request->birth_year,
        'last_company' => $request->last_company,
        'last_position' => $request->last_position,
        'file_path' => $filePath,
    ]);

    // ✅ Redirect về list CV của Pool (theo CxO)
    return redirect()->route('pool.cvs', ['cxoId' => $cxo->id])
                     ->with('success', 'Nộp CV cho pool thành công!');
}


    // ✅ LIST CV cho pool theo CxO
    public function listPoolCvs($cxoId)
    {
        $cxo = Cxo::findOrFail($cxoId);
        $cvs = Cv::where('cxo_id', $cxo->id)->whereNull('job_id')->orderBy('created_at', 'desc')->get();

        return view('cv.pool_list', compact('cvs', 'cxo'));
    }
    public function createFunction()
{
    return view('pool.function_create');
}

public function storeFunction(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    FunctionModel::create($request->only(['name', 'description', 'status']));

    return redirect()->route('pool.index')->with('success', 'Thêm Function thành công!');
}

public function showFunction($id)
{
    $function = FunctionModel::findOrFail($id);
    return view('pool.function_show', compact('function'));
}

public function applyForFunction($functionId)
{
    $function = FunctionModel::findOrFail($functionId);
    return view('pool.apply_function', compact('function'));
}

public function submitForFunction(Request $request, $functionId)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'birth_year' => 'required|integer|between:1900,2100',
        'last_company' => 'nullable|string|max:255',
        'last_position' => 'nullable|string|max:255',
        'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $filePath = $request->file('cv')->store('cvs', 'public');

    Cv::create([
        'job_id' => null,
        'cxo_id' => null,
        'function_id' => $functionId,
        'user_id' => Auth::id(),
        'full_name' => $request->full_name,
        'birth_year' => $request->birth_year,
        'last_company' => $request->last_company,
        'last_position' => $request->last_position,
        'file_path' => $filePath,
    ]);

    return redirect()->route('pool.function.cvs', $functionId)
                     ->with('success', 'Nộp CV thành công!');
}

public function listFunctionCvs($functionId)
{
    $function = FunctionModel::findOrFail($functionId);
    $cvs = Cv::where('function_id', $functionId)->whereNull('job_id')->get();

    return view('pool.function_list', compact('function', 'cvs'));
}
}
