<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\PermissionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use PermissionTrait;
    public function __construct()
    {
        // user permission
        $this->middleware('permission:user-index', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-update', ['only' => ['edit','update']]);
        $this->middleware('permission:user-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:miscellaneous-user_permission', ['only' => ['assign_permission', 'assign_permission_store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('pages.admin.users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'nullable|email:rfc,filter|unique:users,email,',
            'role_id' => 'nullable',
        ]);

        $data = $request->all();

        if($request->input('password')) {
            $data['password'] = Hash::make($request->password);
        }else {
            unset($data['password']);
        }

        if($request->active_status){
            $data['active_status'] = true;
        }else {
            $data['active_status'] = false;
        }

        $user = User::create($data);
        if($request->role_id) {
            $user->assignRole($request->role_id);
        }
        alert()->success("Created", 'User create successfully!');
        return redirect()->route('users');
    }

    // assign user permission
    public function assign_permission(User $user)
    {
        $this->authorize('update', [User::class, $user]);

        $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        $permission_list = $this->permission_list();
        $other_permissions = $this->other_permission_list();
        return view('pages.users.permission', compact('user', 'permissions', 'permission_list', 'other_permissions'));
    }

    // assign user permission store
    public function assign_permission_store(Request $request, User $user)
    {
        $this->authorize('update', [User::class, $user]);
        $permissions = $request->permission;
        // remove all old permission so thant agaim assing permission into role
        $old_permissions = $user->getAllPermissions()->pluck('name')->toArray();
        foreach($old_permissions as $old_permission) {
            $user->revokePermissionTo($old_permission);
        }

        if(!is_null($permissions)) {
            foreach($permissions as $permission) {
                foreach($permission as $value) {
                    $permission_ = Permission::where('name', $value)->first();
                    // assign permission into role
                    $user->givePermissionTo($permission_);
                }
            }
        }
        alert()->success("Updated", 'User permission updated successfully!');
        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        $permission_list = $this->permission_list();
        $other_permissions = $this->other_permission_list();
        return view('pages.admin.users.show', compact('user', 'permissions', 'permission_list', 'other_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('pages.admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email:rfc,filter|unique:users,email,'.$user->id,
            'role_id' => 'nullable',
        ]);

        $data = $request->all();

        if($request->input('password')) {
            $data['password'] = Hash::make($request->password);
        }else {
            unset($data['password']);
        }

        if($request->active_status){
            $data['active_status'] = true;
        }else {
            $data['active_status'] = false;
        }
        $user->update($data);
        if($request->role_id){
            $user->assignRole($request->role_id);
        }
        alert()->success("Updated", 'User update successfully!');
        return redirect()->route('users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success("Deleted", 'User delete Successfull!');
        return redirect()->route('users');
    }
}
