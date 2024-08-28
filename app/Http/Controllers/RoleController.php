<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index(){
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function roleDetail($role){
        $role = Role::findOrFail($role);
        $modules = Module::with('permissions')->get();
        $rolePermissions = $role->permissions->pluck('name')->toArray();


        return view('roles.detail-role', compact('role', 'modules', 'rolePermissions'));
    }

    public function updateRolePermission(Request $request, $role_id){
        $role = Role::findOrFail($role_id);
        $permissionName = $request->input('permission');
        $isChecked = $request->input('isChecked') === 'true';

        if ($isChecked) {
            $role->givePermissionTo($permissionName);
        } else {
            $role->revokePermissionTo($permissionName);
        }

        return response()->json(['success' => true]);
    }
}
