<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use App\Models\Report;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.expenses.index', [
            'title' => trans('admin.All Expenses'),
            'expenses' => Expenses::paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expenses.create', [
            'title' => trans('admin.Add New Expense'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount'          => 'required',
            'description'        => 'required',
        ], [], [
            'amount'          => trans('admin.Amount'),
            'description'        => trans('admin.Description'),
        ]);

        $expense = new Expenses();
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->save();

        Report::create([
            'reportable_type' => "App\Models\Expenses",
            'reportable_id' => $expense->id,
            'amount' => $request->amount,
            'operation' => 'minus',
        ]);

        userLogs([
            'model' => '\App\Models\Expenses',
            'model_id' => $expense->id,
            'description_ar' => 'اضافة مصروفات',
            'description_en' => 'Add New Expenses',
            'status' => 'create'
        ]);
        return redirect(aurl('expenses'))->with('success', 'operation success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expenses::find($id);
        return view('admin.expenses.edit', [
            'title' => $expense->description,
            'expense' => $expense
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'amount'          => 'required',
            'description'        => 'required',
        ], [], [
            'amount'          => trans('admin.Amount'),
            'description'        => trans('admin.Description'),
        ]);

        $expense = Expenses::find($id);
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->save();

        userLogs([
            'model' => '\App\Models\Expenses',
            'model_id' => $expense->id,
            'description_ar' => 'اضافة مصروفات',
            'description_en' => 'Add New Expenses',
            'status' => 'create'
        ]);
        return redirect(aurl('expenses'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $expense = Expenses::find($request->expense_id);
        if ($expense) {
            $expense->delete();
        }
        userLogs([
            'model' => '\App\Models\Expense',
            'model_id' => $request->expense_id,
            'description_ar' => 'حذف المصروفات',
            'description_en' => 'Delete Expense',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }
}
