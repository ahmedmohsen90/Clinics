<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Media;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::with('profile')->where('id', '!=', '1')->latest()->paginate(30);
        return view('admin.admins.index', [
            'title' => trans('admin.All Admins'),
            'admins' => $admins
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        $admins = User::onlyTrashed()->where('user_type', 'admin')->latest()->paginate(30);
        return view('admin.admins.deleted', [
            'title' => trans('admin.All Deleted Admins'),
            'admins' => $admins
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logs($id = null)
    {
        if ($id) {
            $logs = AdminLog::where('user_id', $id)->where('user_id', '!=', '1')->whereHas('user')->with('user')->latest()->paginate(30);
        } else {
            $logs = AdminLog::with('user')->where('user_id', '!=', '1')->latest()->paginate(30);
        }
        return view('admin.admins.logs', [
            'title' => trans('admin.Activity'),
            'logs' => $logs,
            'user' => User::find($id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create', [
            'title' => trans('admin.Add New Admin'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->addRole('admin');

        if ($request->hasFile('image')) {
            ini_set('memory_limit', '-1');
            $file = $request->file('image');
            $image_extension = $file->getClientOriginalExtension();
            $image_imageName = date('mdYHis') . uniqid() . '.' . $image_extension;
            $image_path = date("Y-m-d") . '/';
            File::makeDirectory(public_path('storage/admins/' . $image_path), $mode = 0777, true, true);
            Image::make($file)
                ->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('storage/admins/' . $image_path) . $image_imageName, 80);
            $image = new Media();
            $image->filename = $image_imageName;
            $image->mime = $file->getClientMimeType();
            $image->type = 'profile';
            $image->mediaable_id = $user->id;
            $image->mediaable_type = 'App\Models\User';
            $image->url = url('') . '/storage/admins/' . $image_path . $image_imageName;
            $image->save();
        }

        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $user->id,
            'description_ar' => 'اضافة مشرف جديد',
            'description_en' => 'Add New Admin',
            'status' => 'create'
        ]);
        return redirect(aurl('admins'))->with('success', 'operation success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::where('id', $id)->with('profile')->first();
        return view('admin.admins.edit', [
            'title' => $admin->name,
            'admin' => $admin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required|min:8|unique:users,id,' . $id,
        ], [], [
            'name'          => trans('admin.Name'),
            'mobile'        => trans('admin.Mobile'),
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($request->hasFile('image')) {
            ini_set('memory_limit', '-1');
            $file = $request->file('image');
            $image_extension = $file->getClientOriginalExtension();
            $image_imageName = date('mdYHis') . uniqid() . '.' . $image_extension;
            $image_path = date("Y-m-d") . '/';
            File::makeDirectory(public_path('storage/admins/' . $image_path), $mode = 0777, true, true);
            Image::make($file)
                ->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('storage/admins/' . $image_path) . $image_imageName, 80);
            $image = new Media();
            $image->filename = $image_imageName;
            $image->mime = $file->getClientMimeType();
            $image->type = 'profile';
            $image->mediaable_id = $user->id;
            $image->mediaable_type = 'App\Models\User';
            $image->url = url('') . '/storage/admins/' . $image_path . $image_imageName;
            $image->save();
        }

        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $user->id,
            'description_ar' => 'تعديل بيانات المشرف',
            'description_en' => 'Update Admin Data',
            'status' => 'update'
        ]);
        return redirect(aurl('admins'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->admin_id);
        if ($user) {
            $user->delete();
        }
        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $request->admin_id,
            'description_ar' => 'مسح المشرف',
            'description_en' => 'Delete Admin',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }

    public function force_delete(Request $request)
    {
        $user = User::withTrashed()->find($request->admin_id);
        if ($user) {
            $user->forceDelete();
        }
        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $request->admin_id,
            'description_ar' => 'حذف نهائى للمشرف',
            'description_en' => 'Force Delete Admin',
            'status' => 'delete'
        ]);
        return back()->with('success', 'operation success');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
        }
        userLogs([
            'model' => '\App\Models\User',
            'model_id' => $id,
            'description_ar' => 'استعادة المشرف',
            'description_en' => 'Restore Admin',
            'status' => 'update'
        ]);
        return back()->with('success', 'operation success');
    }
}
