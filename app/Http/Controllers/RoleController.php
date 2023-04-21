<?php

namespace App\Http\Controllers;

use App\Traits\PermissionTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use PermissionTrait;
    // set user permission
    public function __construct()
    {
        $this->middleware('permission:role-index')->only(['index', 'show']);
        $this->middleware('permission:role-create')->only(['create', 'store']);
        $this->middleware('permission:role-update')->only(['edit', 'update']);
        $this->middleware('permission:role-destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->edit) {
            $edit = true;
            $roles = Role::all();
            $role_ = Role::find($request->role);
            return view('pages.role.index', compact('roles', 'role_', 'edit'));
        }
        $edit = false;
        $roles = Role::all();
        return view('pages.admin.role.index', compact('roles', 'edit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store Role permission
     */
    public function permission($role)
    {
        $role = Role::find($role);
        $permissions = $role->permissions->pluck('name')->toArray();
        $permission_list = $this->permission_list();
        $other_permissions = $this->other_permission_list();
        return view('pages.admin.permission.index', compact('role', 'permissions', 'permission_list', 'other_permissions'));
    }

    // store role permission
    public function permission_store(Request $request, $role) {

        $permissions = $request->permission;
        $role = Role::find($role);

        // remove all old permission so thant agaim assing permission into role
        $old_permissions = $role->permissions->pluck('name')->toArray();
        foreach($old_permissions as $old_permission) {
            $role->revokePermissionTo($old_permission);
        }
        if(!is_null($permissions)) {
            foreach($permissions as $permission) {
                foreach($permission as $value) {
                    // create permission if not exist in permission table
                    $permission_ = Permission::where('name', $value)->first();
                    if(is_null($permission_)) {
                        $permission_ = Permission::create(['name' => $value]);
                    }
                    // assign permission into role
                    $role->givePermissionTo($permission_);
                    // $permission_->assignRole($role);
                }
            }
        }
        return back()->with('updated', 'Role permission updated successfully!');
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
            'name' => 'required'
        ]);

        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('created', 'Role Create Successfull');
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
        return redirect()->route('roles.index', ['role' => $id, 'edit' => true]);
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
            'name' => 'required'
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('roles.index')->with('updated', 'Role Updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index')->with('deleted', 'Role has been deleted!');
    }
}
