<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\InsuranceCompany;
use App\Models\Specialization;
use App\Models\SpecializationWallet;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.wallets.index', [
            'title' => trans('admin.All Packages'),
            'packages' => Wallet::with('customer', 'specializations')->paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = InsuranceCompany::where('status', 1)->get();
        return view('admin.wallets.create', [
            'title' => trans('admin.Add New Package'),
            'customers' => Customer::get(),
            'specializations' => Specialization::get(),
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer'          => 'required',
            'cases_number'          => 'required',
            'price'          => 'required',
        ], [], [
            'customer'          => trans('admin.Customer'),
            'cases_number'          => trans('admin.Sessions Number'),
            'price'          => trans('admin.Price'),
        ]);

        $wallet = new Wallet();
        $wallet->company_id = session('company_id');
        $wallet->customer_id = $request->customer;
        $wallet->cases_number = $request->cases_number;
        $wallet->price = $request->price;
        $wallet->insurance_company_id = $request->company;
        $wallet->save();

        foreach ($request->specializations as $specialization) {
            SpecializationWallet::create([
                'wallet_id' => $wallet->id,
                'specialization_id' => $specialization
            ]);
        }

        userLogs([
            'model' => '\App\Models\Wallet',
            'model_id' => $wallet->id,
            'description_ar' => 'اضافة باقة جديدة',
            'description_en' => 'Add New Package',
            'status' => 'create'
        ]);
        return redirect(aurl('packages'))->with('success', 'operation success');
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
