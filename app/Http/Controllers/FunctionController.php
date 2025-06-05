<?php

namespace App\Http\Controllers;

use App\Models\FunctionModel;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    //
    public function create()
{
    return view('pool.function.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    FunctionModel::create($request->only('name'));

    return redirect()->route('pool.index')->with('success', 'Function created!');
}

public function show($id)
{
    $function = FunctionModel::with('jobs')->findOrFail($id);
    return view('pool.function.show', compact('function'));
}

}
