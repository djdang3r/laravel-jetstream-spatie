<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        $users = User::All();
        $total_users = User::count();
        $new_users = $this->countNewUsers();
        $deleted_users = User::onlyTrashed()->count();


        $data = [];
        
        foreach ($users as $user) {
            // Definir los botones
            //$btnEdit = '<a href="/users/edit/'.$user->id.'" class="btn btn-primary">Edit</a>';
            $btnEdit = '<a href="/users/edit/'.$user->id.'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
            //$btnDelete = '<a href="/users/delete/'.$user->id.'" class="btn btn-danger">Delete</a>';
            $btnDelete = '<a href="/users/delete/'.$user->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                  </a>';
            //$btnDetails = '<a href="/users/'.$user->id.'" class="btn btn-info">Details</a>';
            $btnDetails = '<a href="/users/'.$user->id.'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                      <i class="fa fa-lg fa-fw fa-eye"></i>
                  </a>';
    
            // Añadir los datos del usuario al arreglo 'data'
            $data[] = [
                $user->id,
                $user->name,
                $user->email,
                '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'
            ];
        }
        return view('users.index', compact('users','total_users', 'new_users', 'deleted_users', 'data'));
    }

    public function profile() {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $modules = Module::with('permissions')->get();
        $canEditPermissions = $user->hasPermissionTo('create user');
        $userPermissions = $user->getAllPermissions();
        $superAdminCount = User::with('roles')->get();

        $roles = $user->getRoleNames(); 

        return view('users.user-profile', compact('user', 'roles', 'modules', 'userPermissions', 'canEditPermissions'));
    }

    public function countNewUsers()
    {
        $last24Hours = Carbon::now()->subDay();
        $newUsersCount = User::where('created_at', '>=', $last24Hours)->count();
        return $newUsersCount;
    }

    public function assignPermission(Request $request, User $user)
{
        $permissionName = $request->input('permission');
        $isChecked = $request->input('isChecked');

        if ($isChecked === 'true') { 
            $user->givePermissionTo($permissionName);
        } else {
            $user->revokePermissionTo($permissionName);
        }

        return response()->json(['status' => 'success']);
    }
    
}
