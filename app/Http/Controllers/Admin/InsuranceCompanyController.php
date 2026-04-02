<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\Debt;
use App\Models\InsuranceCompany;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.insurance_companies.index', [
            'title' => trans('admin.Insurance Companies'),
            'insurance_companies' => InsuranceCompany::paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.insurance_companies.create', [
            'title' => trans('admin.Add New Company'),
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

        $company = new InsuranceCompany();
        $company->company_id = session('company_id');
        $company->name = $request->name;
        $company->save();

        userLogs([
            'model' => '\App\Models\InsuranceCompany',
            'model_id' => $company->id,
            'description_ar' => 'اضافة شركة تأمين',
            'description_en' => 'Add New Insurance Company',
            'status' => 'create'
        ]);
        return redirect(aurl('insurance_companies'))->with('success', 'operation success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = InsuranceCompany::find($id);
        return view('admin.insurance_companies.edit', [
            'title' => $company->name,
            'company' => $company
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

        $company = InsuranceCompany::find($id);
        $company->name = $request->name;
        $company->save();

        userLogs([
            'model' => '\App\Models\InsuranceCompany',
            'model_id' => $company->id,
            'description_ar' => 'اضافة شركة تأمين',
            'description_en' => 'Add New Insurance Company',
            'status' => 'create'
        ]);
        return redirect(aurl('insurance_companies'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $status, int $id)
    {
        $company = InsuranceCompany::find($id);
        $company->status = $status;
        $company->save();
        return back()->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $company = InsuranceCompany::find($request->company_id);
        if ($company) {
            $company->delete();
        }
        userLogs([
            'model' => '\App\Models\InsuranceCompany',
            'model_id' => $request->company_id,
            'description_ar' => 'حذف شركة التأمين',
            'description_en' => 'Delete Insurance Company',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }

    public function financials(int $id)
    {
        $company = InsuranceCompany::find($id);

        $debts = Debt::where([
            'debtable_type' => "App\Models\InsuranceCompany",
            'debtable_id' => $company->id,
        ])->latest()->paginate(50);

        $entitlements = Accounting::where([
            'operation' => 'minus',
            'accountingable_type' => "App\Models\InsuranceCompany",
            'accountingable_id' => $company->id,
        ])->sum('amount');

        $collected = Accounting::where([
            'operation' => 'plus',
            'accountingable_type' => "App\Models\InsuranceCompany",
            'accountingable_id' => $company->id,
        ])->sum('amount');

        $paymentMethods = PaymentMethod::get();

        return view('admin.insurance_companies.financials', [
            'title' => trans('admin.Financials') . " - " . $company->name,
            'debts' => $debts,
            'company' => $company,
            'entitlements' => $entitlements,
            'collected' => $collected,
            'paymentMethods'=>$paymentMethods
        ]);
    }
}
