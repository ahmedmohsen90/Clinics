<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerCase;
use App\Models\InsuranceCompany;
use App\Models\InsuranceCustomer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('company.company')->paginate(50);
        return view('admin.customers.index', [
            'title' => trans('admin.All Customers'),
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = InsuranceCompany::where('status', 1)->get();
        return view('admin.customers.create', [
            'title' => trans('admin.Add New Customer'),
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required',
            'job'        => 'required',
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            'job'        => trans('admin.Job'),
        ]);

        if (!checkdate($request->month, $request->day, $request->year)) {
            return back()->withErrors(['birthdate' => trans('admin.Wrong Birthdate')]);
        }

        $birthdate = $request->year . '-' . $request->month . '-' . $request->day;
        $birthdate = \Carbon\Carbon::createFromFormat('Y-n-j', $birthdate)->format('Y-m-d');

        $customer = new Customer();
        $customer->company_id = session('company_id');
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->job = $request->job;
        $customer->birthdate = $birthdate;
        $customer->save();

        if ($request->company != 0) {
            InsuranceCustomer::create([
                'customer_id' => $customer->id,
                'insurance_company_id' => $request->company,
                'insurance_number' => $request->insurance_number,
                'company_percentage' => $request->percentage,
                'national_id' => $request->national_id,
            ]);
        }

        userLogs([
            'model' => '\App\Models\Customer',
            'model_id' => $customer->id,
            'description_ar' => 'اضافة عميل جديد',
            'description_en' => 'Add New Customer',
            'status' => 'create'
        ]);
        return redirect(aurl('customers'))->with('success', 'operation success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::with('company')->where('id', $id)->first();
        $cases = CustomerCase::with('specialization', 'doctor')->where('customer_id', $id)->paginate(50);
        return view('admin.customers.view', [
            'title' => $customer->name,
            'customer' => $customer,
            'cases' => $cases
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::with('company')->where('id', $id)->first();
        $companies = InsuranceCompany::where('status', 1)->get();
        return view('admin.customers.edit', [
            'title' => $customer->name,
            'customer' => $customer,
            'companies' => $companies

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required',
            'job'        => 'required',
            'birthdate'        => 'nullable',
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            'job'        => trans('admin.Job'),
            'birthdate'        => trans('admin.Birthdate'),
        ]);

        if (!checkdate($request->month, $request->day, $request->year)) {
            return back()->withErrors(['birthdate' => trans('admin.Wrong Birthdate')]);
        }

        $birthdate = $request->year . '-' . $request->month . '-' . $request->day;
        $birthdate = \Carbon\Carbon::createFromFormat('Y-n-j', $birthdate)->format('Y-m-d');

        $customer = Customer::with('company')->where('id', $id)->first();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->job = $request->job;
        $customer->birthdate = $birthdate;
        $customer->save();

        if ($request->company != 0) {
            InsuranceCustomer::updateOrCreate(
                [
                    'customer_id' => $id
                ],
                [
                    'insurance_company_id' => $request->company,
                    'insurance_number' => $request->insurance_number,
                    'company_percentage' => $request->percentage,
                    'national_id' => $request->national_id,
                ]
            );
        } else {
            InsuranceCustomer::where('customer_id', $id)->delete();
        }

        userLogs([
            'model' => '\App\Models\Customer',
            'model_id' => $customer->id,
            'description_ar' => 'تحديث بيانات العميل',
            'description_en' => 'Update Customer Details',
            'status' => 'create'
        ]);
        return redirect(aurl('customers'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        if ($customer) {
            $customer->delete();
        }
        userLogs([
            'model' => '\App\Models\Customer',
            'model_id' => $request->customer_id,
            'description_ar' => 'حذف العميل',
            'description_en' => 'Delete Customer',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }
}
