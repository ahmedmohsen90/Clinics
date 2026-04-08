<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerCase;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\SpecializationDoctor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctors.index', [
            'title' => trans('admin.All Doctors'),
            'doctors' => Doctor::with('specializations.specialization')->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function by_specialization(int $id)
    {
        try {
            $doctors = Doctor::whereHas('specializations', function ($query) use ($id) {
                $query->where('specialization_id', $id);
            })->get();

            return responseSuccess('doctors', $doctors);
        } catch (Exception $ex) {
            return responseValid($ex);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctors.create', [
            'title' => trans('admin.Add New Doctor'),
            'specializations' => Specialization::get()
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
            "specializations"        => "required|array|min:1",
            "specializations.*"      => "required",
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            "specializations"        => "required|array|min:1",
        ]);

        $doctor = new Doctor();
        $doctor->company_id = session('company_id');
        $doctor->name = $request->name;
        $doctor->mobile = $request->mobile;
        $doctor->save();

        foreach ($request->specializations as $specialization) {
            SpecializationDoctor::create([
                'doctor_id' => $doctor->id,
                'specialization_id' => $specialization
            ]);
        }

        userLogs([
            'model' => '\App\Models\Doctor',
            'model_id' => $doctor->id,
            'description_ar' => 'اضافة دكتور جديد',
            'description_en' => 'Add New Doctor',
            'status' => 'create'
        ]);
        return redirect(aurl('doctors'))->with('success', 'operation success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(int $id)
    {
        $doctor = Doctor::with('specializations.specialization')->where('id', $id)->first();
        $cases = CustomerCase::with('customer', 'specialization')->where('doctor_id', $id)->paginate(50);

        $casestoday = DB::table('customer_cases')->select('id')->where('doctor_id', $id)->whereDate('created_at', date('Y-m-d'))->count();
        $casesweek = DB::table('customer_cases')->select('id')->where('doctor_id', $id)->whereBetween('created_at', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()])->count();
        $casesmonth = DB::table('customer_cases')->select('id')->where('doctor_id', $id)->whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])->count();

        return view('admin.doctors.view', [
            'title' => $doctor->name,
            'doctor' => $doctor,
            'cases' => $cases,
            'casestoday' => $casestoday,
            'casesweek' => $casesweek,
            'casesmonth' => $casesmonth,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $doctor = Doctor::find($id);
        return view('admin.doctors.edit', [
            'title' => $doctor->name,
            'doctor' => $doctor,
            'specializations' => Specialization::get(),
            'specializationsDoctors' => SpecializationDoctor::where('doctor_id', $id)->get()->pluck('specialization_id')
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
            "specializations"        => "required|array|min:1",
            "specializations.*"      => "required",
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            "specializations"        => "required|array|min:1",
        ]);

        $doctor = Doctor::find($id);
        $doctor->name = $request->name;
        $doctor->mobile = $request->mobile;
        $doctor->save();

        SpecializationDoctor::where('doctor_id', $id)->delete();
        foreach ($request->specializations as $specialization) {
            SpecializationDoctor::create([
                'doctor_id' => $doctor->id,
                'specialization_id' => $specialization
            ]);
        }

        userLogs([
            'model' => '\App\Models\Doctor',
            'model_id' => $doctor->id,
            'description_ar' => 'تحديث بيانات الدكتور',
            'description_en' => 'Update Doctor Details',
            'status' => 'update'
        ]);
        return redirect(aurl('doctors'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $doctor = Doctor::find($request->doctor_id);
        if ($doctor) {
            $doctor->delete();
        }
        userLogs([
            'model' => '\App\Models\Doctor',
            'model_id' => $request->doctor_id,
            'description_ar' => 'حذف الدكتور',
            'description_en' => 'Delete Doctor',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }
}
