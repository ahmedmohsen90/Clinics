<?php

namespace App\Http\Controllers\Admin;

use App\Events\AccountingEvent;
use App\Events\PaymentMethodEvent;
use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodTransaction;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.payment_methods.index', [
            'title' => trans('admin.Payment Method'),
            'methods' => PaymentMethod::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment_methods.create', [
            'title' => trans('admin.Add New Payment Method'),
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

        $method = new PaymentMethod();
        $method->company_id = session('company_id');
        $method->name = $request->name;
        $method->save();

        userLogs([
            'model' => '\App\Models\PaymentMethod',
            'model_id' => $method->id,
            'description_ar' => 'اضافة عملية دفع جديدة',
            'description_en' => 'Add New Payment Method',
            'status' => 'create'
        ]);
        return redirect(aurl('payment_methods'))->with('success', 'operation success');
    }

    /**
     * Display the specified resource.
     */
    public function financials(int $id)
    {
        $method = PaymentMethod::find($id);
        $total = Accounting::where(["accountingable_type" => "App\Models\PaymentMethod", "accountingable_id" => $id])->sum('amount');
        $logs = PaymentMethodTransaction::where('payment_method_id', $id)->latest()->paginate(50);
        $paymentMethods = PaymentMethod::where('id', '!=', $id)->get();

        return view('admin.payment_methods.financials', [
            'title' => $method->name . " - " . trans('admin.Logs'),
            'total' => $total,
            'logs' => $logs,
            'method' => $method,
            'paymentMethods' => $paymentMethods
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $method = PaymentMethod::find($id);
        return view('admin.payment_methods.edit', [
            'title' => $method->name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'          => 'required',
        ], [], [
            'name'          => trans('admin.Name'),
        ]);

        $method = PaymentMethod::find($id);
        $method->name = $request->name;
        $method->save();

        userLogs([
            'model' => '\App\Models\PaymentMethod',
            'model_id' => $method->id,
            'description_ar' => 'تحديث بيانات عملية الدفع',
            'description_en' => 'Update Payment Method Details',
            'status' => 'update'
        ]);
        return redirect(aurl('insurance_companies'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function transfer(Request $request)
    {
        // Current Payment Method Must Be Minus Update In Accounting
        $dataAccountingCurremntPMethod = [
            "accountingable_type" => 'App\Models\PaymentMethod',
            "accountingable_id" => $request->current_payment_method_id,
            "operation" => 'minus',
            "amount" => $request->amount,
        ];
        event(new AccountingEvent($dataAccountingCurremntPMethod));

        // The Payment Method Had Transferred Must Be Plus Update In Accounting
        $dataAccountingTransferred = [
            "accountingable_type" => 'App\Models\PaymentMethod',
            "accountingable_id" => $request->payment_method_id,
            "operation" => 'plus',
            "amount" => $request->amount,
        ];
        event(new AccountingEvent($dataAccountingTransferred));

        // Current Payment Method Log Must Be Minus
        $dataCurrentPaymentMethod = [
            "payment_id" => $request->current_payment_method_id,
            "amount" => $request->amount,
            "operation" => "minus",
            'description' => $request->description,
        ];
        event(new PaymentMethodEvent($dataCurrentPaymentMethod));

        // New Payment Method Log Must Be Plus
        $dataPaymentMethod = [
            "payment_id" => $request->payment_method_id,
            "amount" => $request->amount,
            "operation" => "plus",
            'description' => $request->description,
        ];
        event(new PaymentMethodEvent($dataPaymentMethod));

        return back()->with('success', 'operation success');
    }
}
