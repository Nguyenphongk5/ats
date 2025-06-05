<?php

namespace App\Http\Controllers;

use App\Models\Cxo;
use App\Models\CxoJob;
use Illuminate\Http\Request;

class CxoJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($cxo_id)
    {
        //
           $cxo = Cxo::findOrFail($cxo_id);
        $jobs = $cxo->cxoJobs()->get();

        return view('cxo_jobs.index', compact('cxo', 'jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Lấy CxO theo ID
    $cxo = Cxo::findOrFail($id);

    // Lấy job mới nhất của CxO đó, hoặc bạn có thể lấy nhiều job nếu muốn
    $cxo_job = $cxo->jobs()->latest()->first(); // hoặc ->get() nếu nhiều job

    return view('pool.show', compact('cxo_job'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
