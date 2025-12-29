<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(50);
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
        return view('admin.customers.create', [
            'title' => trans('admin.Add New Customer'),
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
            'age'        => 'required',
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            'job'        => trans('admin.Job'),
            'age'        => trans('admin.Age'),
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->job = $request->job;
        $customer->age = $request->age;
        $customer->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.edit', [
            'title' => $customer->name,
            'customer' => $customer
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
            'age'        => 'required',
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            'job'        => trans('admin.Job'),
            'age'        => trans('admin.Age'),
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->job = $request->job;
        $customer->age = $request->age;
        $customer->save();

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
