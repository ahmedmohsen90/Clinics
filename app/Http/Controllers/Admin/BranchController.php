<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.branches.index', [
            'title' => trans('admin.All Branches'),
            'branches' => Branch::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.branches.create', [
            'title' => trans('admin.Add New Branch'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
        ], [], [
            'name'          => trans('admin.Name'),
        ]);

        $branch = new Branch();
        $branch->company_id = session('company_id');
        $branch->name = $request->name;
        $branch->save();

        return redirect(aurl('branches'))->with('success', 'operation success');
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
