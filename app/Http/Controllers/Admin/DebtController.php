<?php

namespace App\Http\Controllers\Admin;

use App\Events\AccountingEvent;
use App\Events\PaymentMethodEvent;
use App\Http\Controllers\Controller;
use App\Listeners\PaymentMethodTransactionListner;
use App\Models\Debt;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debts = Debt::where([
            'debtable_type' => "App\Models\InsuranceCompany",
        ])->with('debtable')->latest()->paginate(50);

        $entitlements = DB::table('accountings')->where([
            'operation' => 'minus',
            'accountingable_type' => "App\Models\InsuranceCompany",
        ])->sum('amount');

        $collected = DB::table('accountings')->where([
            'operation' => 'plus',
            'accountingable_type' => "App\Models\InsuranceCompany",
        ])->sum('amount');

        return view('admin.debts.index', [
            'title' => trans('admin.All Debts'),
            'debts' => $debts,
            'entitlements' => $entitlements,
            'collected' => $collected,
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
            'amount'        => 'required',
            'description'        => 'nullable',
        ], [], [
            'amount'        => trans('admin.Amount'),
            'description'        => trans('admin.Description'),
        ]);

        $debt = new Debt();
        $debt->company_id = session('company_id');
        $debt->debtable_type = $request->debtable_type;
        $debt->debtable_id = $request->company_id;
        $debt->amount = $request->amount;
        $debt->description = $request->description;
        $debt->operation = $request->operation;
        $debt->payment_method_id = $request->payment_method_id;
        $debt->save();

        if ($request->debtable_type == "App\Models\InsuranceCompany") {
            $dataInsuranceCompany = [
                "accountingable_type" => "App\Models\InsuranceCompany",
                "accountingable_id" => $request->company_id,
                "operation" => 'plus',
                "amount" => $request->amount,
            ];
            event(new AccountingEvent($dataInsuranceCompany));
        }

        $dataTotalPayment = [
            "accountingable_type" => "App\Models\PaymentMethod",
            "accountingable_id" => $request->payment_method_id,
            "operation" => 'plus',
            "amount" => $request->amount,
        ];
        event(new AccountingEvent($dataTotalPayment));

        $dataPaymentMethod = [
            "payment_id" => $request->payment_method_id,
            "amount" => $request->amount,
            "operation" => $request->operation == "collected" ? 'plus' : "minus",
            "description" => $request->description
        ];
        event(new PaymentMethodEvent($dataPaymentMethod));

        Report::create([
            'company_id' => session('company_id'),
            'reportable_type' => "App\Models\Debt",
            'reportable_id' => $debt->id,
            'amount' => $request->amount,
            'operation' => ($request->operation == "collected") ? 'plus' : 'minus',
        ]);
        return back()->with('success', 'operation success');
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
