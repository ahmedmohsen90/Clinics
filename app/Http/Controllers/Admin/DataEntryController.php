<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.data_entries.index', [
            'title' => trans('admin.All Data Entries'),
            'data_entries' => User::whereHasRole('dentry')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_entries.create', [
            'title' => trans('admin.Add New Data Entry'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required|min:8|unique:users',
            'password'      => 'required|min:6',
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            'password'      => trans('admin.Password'),
        ]);

        $dentry = new User();
        $dentry->name = $request->name;
        $dentry->mobile = $request->mobile;
        $dentry->password = Hash::make($request->password);
        $dentry->save();
        $dentry->addRole('dentry');

        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $dentry->id,
            'description_ar' => 'اضافة مدخل بيانات جديد',
            'description_en' => 'Add New Data Entry',
            'status' => 'create'
        ]);
        return redirect(aurl('data_entries'))->with('success', 'operation success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dentry = User::where('id', $id)->first();
        return view('admin.data_entries.edit', [
            'title' => $dentry->name,
            'dentry' => $dentry,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required|min:8|unique:users',
            'password'      => 'required|min:6',
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
            'password'      => trans('admin.Password'),
        ]);

        $dentry = User::where('id', $id)->first();
        $dentry->name = $request->name;
        $dentry->mobile = $request->mobile;
        $dentry->password = Hash::make($request->password);
        $dentry->save();

        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $dentry->id,
            'description_ar' => 'تحديث بيانات مدخل بيانات',
            'description_en' => 'Update Data Entry Details',
            'status' => 'update'
        ]);
        return redirect(aurl('data_entries'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->data_entry_id);
        if ($user) {
            $user->delete();
        }
        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $request->data_entry_id,
            'description_ar' => 'مسح المشرف',
            'description_en' => 'Delete Admin',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }
}
