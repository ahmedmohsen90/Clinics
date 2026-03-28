<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Debt;
use App\Models\Report;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.debts.index', [
            'title' => trans('admin.All Debts'),
            'debts' => Debt::latest()->paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.debts.create', [
            'title' => trans('admin.Add New Debt'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'amount'        => 'required',
            'note'        => 'nullable',
        ], [], [
            'name'          => trans('admin.Name'),
            'amount'        => trans('admin.Amount'),
            'note'        => trans('admin.Note'),
        ]);

        $debt = Debt::create([
            'company_id' => session('company_id'),
            'name' => $request->name,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        Report::create([
            'reportable_type' => "App\Models\Debt",
            'reportable_id' => $debt->id,
            'amount' => $request->amount,
            'operation' => 'minus',
        ]);
        return redirect(aurl('debts'))->with('success', 'operation success');
    }

    /**
     * Display the specified resource.
     */
    public function collection(int $id)
    {
        $debt = Debt::find($id);
        $debt->is_collection = 1;
        $debt->save();

        Report::create([
            'reportable_type' => "App\Models\Debt",
            'reportable_id' => $debt->id,
            'amount' => $debt->amount,
            'operation' => 'plus',
        ]);

        return back()->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $debt = Debt::find($request->debt_id);
        if ($debt) {
            $debt->delete();
        }
        userLogs([
            'model' => '\App\Models\Debt',
            'model_id' => $request->debt_id,
            'description_ar' => 'حذف المديونية',
            'description_en' => 'Delete Debt',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }
}
