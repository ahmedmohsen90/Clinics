<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerCase;
use App\Models\CustomerCaseStatus;
use App\Models\Doctor;
use App\Models\Report;
use App\Models\Specialization;
use Illuminate\Http\Request;

class CustomerCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cases = CustomerCase::with('customer', 'specialization', 'doctor')->paginate(50);
        return view('admin.cases.index', [
            'title' => trans('admin.All Cases'),
            'cases' => $cases
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = Specialization::get();
        $customers = Customer::get();
        return view('admin.cases.create', [
            'title' => trans('admin.Add New Case'),
            'specializations' => $specializations,
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(int $id)
    {
        $case = CustomerCase::where('id', $id)->with('statuses', 'customer', 'doctor', 'specialization')->first();


        $start = CustomerCaseStatus::where('customer_case_id', $case->id)
            ->where('status', 'start')
            ->orderBy('created_at')
            ->first();

        $end = CustomerCaseStatus::where('customer_case_id', $case->id)
            ->where('status', 'end')
            ->orderBy('created_at')
            ->first();

        $durationMinutes = 0;
        if ($start && $end) {
            $durationMinutes = $start->created_at->diffInMinutes($end->created_at);
        }

        return view('admin.cases.view', [
            'title' => $case->customer->name,
            'case' => $case,
            'durationMinutes' => $durationMinutes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer'          => 'required',
            'specialization'          => 'required',
            'doctor'          => 'required',
            'amount'          => 'required',
        ], [], [
            'customer'          => trans('admin.Customer'),
            'specialization'          => trans('admin.Specialization'),
            'doctor'          => trans('admin.Doctor'),
            'amount'          => trans('admin.Amount'),
        ]);

        $case = new CustomerCase();
        $case->customer_id = $request->customer;
        $case->specialization_id = $request->specialization;
        $case->doctor_id = $request->doctor;
        $case->amount = $request->amount;
        $case->note = $request->note;
        $case->save();

        CustomerCaseStatus::create([
            'customer_case_id' => $case->id,
            'status' => 'pending',
        ]);

        userLogs([
            'model' => '\App\Models\CustomerCase',
            'model_id' => $case->id,
            'description_ar' => 'اضافة حالة جديد',
            'description_en' => 'Add New Case',
            'status' => 'create'
        ]);
        return redirect(aurl('cases'))->with('success', 'operation success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specializations = Specialization::get();
        $customers = Customer::get();
        $case = CustomerCase::find($id);

        $doctors = Doctor::whereHas('specializations', function ($query) use ($case) {
            $query->where('specialization_id', $case->specialization_id);
        })->get();

        return view('admin.cases.edit', [
            'title' => $case->customer->name,
            'specializations' => $specializations,
            'customers' => $customers,
            'case' => $case,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer'          => 'required',
            'specialization'          => 'required',
            'doctor'          => 'required',
            'amount'          => 'required',
        ], [], [
            'customer'          => trans('admin.Customer'),
            'specialization'          => trans('admin.Specialization'),
            'doctor'          => trans('admin.Doctor'),
            'amount'          => trans('admin.Amount'),
        ]);

        $case = CustomerCase::find($id);
        $case->customer_id = $request->customer;
        $case->specialization_id = $request->specialization;
        $case->doctor_id = $request->doctor;
        $case->amount = $request->amount;
        $case->note = $request->note;
        $case->save();

        userLogs([
            'model' => '\App\Models\CustomerCase',
            'model_id' => $case->id,
            'description_ar' => 'تحديث بيانات الحالة',
            'description_en' => 'Update Case Details',
            'status' => 'update'
        ]);
        return redirect(aurl('cases'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $case = CustomerCase::find($request->case_id);
        if ($case) {
            $case->delete();
        }
        userLogs([
            'model' => '\App\Models\CustomerCase',
            'model_id' => $request->case_id,
            'description_ar' => 'حذف الحالة',
            'description_en' => 'Delete Case',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }

    public function status(string $status, int $id)
    {
        $case = CustomerCase::find($id);

        if ($status == "start") {
            Report::create([
                'reportable_type' => "App\Models\CustomerCase",
                'reportable_id' => $id,
                'amount' => $case->amount,
            ]);
        }

        CustomerCaseStatus::create([
            'customer_case_id' => $id,
            'status' => $status,
            'payment_status' => 'paid',
        ]);

        return back()->with('success', 'operation success');
    }
}
