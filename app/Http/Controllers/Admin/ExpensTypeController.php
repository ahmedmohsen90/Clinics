<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ExpensType;
use Illuminate\Http\Request;

class ExpensTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::get();
        return view('admin.expenses_types.index', [
            'title' => trans('admin.Types'),
            'expenses' => ExpensType::paginate(50),
            'branches' => $branches
        ]);
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
        $request->validate([
            'branch_id'          => 'required',
            'name'        => 'required|max:70|unique:expens_types,name',
        ], [], [
            'branch_id'          => trans('admin.Branch'),
            'name'        => trans('admin.Name'),
        ]);

        $expense = new ExpensType();
        $expense->company_id = session('company_id');
        $expense->branch_id = $request->branch_id;
        $expense->name = $request->name;
        $expense->save();

        userLogs([
            'model' => '\App\Models\ExpensType',
            'model_id' => $expense->id,
            'description_ar' => 'اضافة نوع مصروفات',
            'description_en' => 'Add New Expens Type',
            'status' => 'create'
        ]);
        return back()->with('success', 'operation success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
