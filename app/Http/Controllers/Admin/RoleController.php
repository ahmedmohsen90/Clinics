<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\Table;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index', [
            'title' => trans('admin.All Roles'),
            'roles' => Role::withCount('admins')->where('id', '!=', 1)->paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::with('permissions')->get();

        return view('admin.roles.create', [
            'title' => trans('admin.Add New Role'),
            'tables' => $tables
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
            'name'                  => 'required|string|max:255|unique:roles|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'display_name'       => 'required',
            'description'        => 'nullable',
            "permissions"           => "required|array|min:1",
            "permissions.*"         => "required",
        ], [], [
            'name'                  => trans('admin.Role Name'),
            'display_name'       => trans('admin.Name'),
            'description'        => trans('admin.Description'),
            'permissions'           => trans('admin.Permissions'),
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        foreach ($request->permissions as $permission) {
            $perm = Permission::find($permission);
            $role->givePermission($perm);
        }

        userLogs([
            'model' => '\App\Models\Role',
            'model_id' => $role->id,
            'description_ar' => 'اضافة تصاريح جديدة',
            'description_en' => 'Add New Permissions',
            'status' => 'create'
        ]);

        return redirect(aurl('roles'))->with('success', 'operation success');
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
        $tables = Table::with('permissions')->get();
        $role = Role::where('id', $id)->first();
        $permissionsId = PermissionRole::where('role_id', $id)->get()->pluck('permission_id');
        $tableIds = Permission::whereIn('id', $permissionsId)->get()->pluck('table_id');
        return view('admin.roles.edit', [
            'title' => $role->display_name,
            'tables' => $tables,
            'role' => $role,
            'permissionsId' => $permissionsId,
            'tableIds' => $tableIds,
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
            'display_name'       => 'required',
            'description'        => 'nullable',
            "permissions"           => "required|array|min:1",
            "permissions.*"         => "required",
        ], [], [
            'display_name'       => trans('admin.Name'),
            'description'        => trans('admin.Description'),
            'permissions'           => trans('admin.Permissions'),
        ]);

        $role = Role::where('id', $id)->first();
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        PermissionRole::where('role_id', $id)->delete();
        foreach ($request->permissions as $permission) {
            $perm = Permission::find($permission);
            $role->givePermission($perm);
        }

        userLogs([
            'model' => '\App\Models\Role',
            'model_id' => $role->id,
            'description_ar' => 'تحديث بيانات التصاريح',
            'description_en' => 'Update Permissions Details',
            'status' => 'update'
        ]);

        return redirect(aurl('roles'))->with('success', 'operation success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $role = Role::where('id', $request->role_id)->first();
        if ($role) {
            $role->delete();
        }

        userLogs([
            'model' => '\App\Models\Role',
            'model_id' => $request->role_id,
            'description_ar' => 'حضف التصريح',
            'description_en' => 'Delete Permissions',
            'status' => 'delete'
        ]);

        return redirect(aurl('roles'))->with('success', 'operation success');
    }
}
