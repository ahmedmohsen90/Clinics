<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.specializations.index', [
            'title' => trans('admin.All Specializations'),
            'specializations' => Specialization::withCount('doctors')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.specializations.create', [
            'title' => trans('admin.Add New Specialization'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'price'        => 'required',
        ], [], [
            'name'          => trans('admin.Name'),
            'price'        => trans('admin.Price'),
        ]);

        $specialization = new Specialization();
        $specialization->name = $request->name;
        $specialization->price = $request->price;
        $specialization->save();

        userLogs([
            'model' => '\App\Models\Specialization',
            'model_id' => $specialization->id,
            'description_ar' => 'اضافة تخصص جديد',
            'description_en' => 'Add New Specialization',
            'status' => 'create'
        ]);
        return redirect(aurl('specializations'))->with('success', 'operation success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specialization = Specialization::find($id);
        return view('admin.specializations.edit', [
            'title' => $specialization->name,
            'specialization' => $specialization
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'          => 'required',
            'price'        => 'required',
        ], [], [
            'name'          => trans('admin.Name'),
            'price'        => trans('admin.Price'),
        ]);

        $specialization = Specialization::find($id);
        $specialization->name = $request->name;
        $specialization->price = $request->price;
        $specialization->save();

        userLogs([
            'model' => '\App\Models\Specialization',
            'model_id' => $specialization->id,
            'description_ar' => 'تحديث بيانات التخصص',
            'description_en' => 'Update Specialization Details',
            'status' => 'update'
        ]);
        return redirect(aurl('specializations'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $specialization = Specialization::find($request->specialization_id);
        if ($specialization) {
            $specialization->delete();
        }
        userLogs([
            'model' => '\App\Models\Specialization',
            'model_id' => $request->specialization_id,
            'description_ar' => 'حذف التخصص',
            'description_en' => 'Delete Specialization',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }
}
