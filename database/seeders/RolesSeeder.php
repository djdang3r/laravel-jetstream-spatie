<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role_root = Role::create(['name' => 'root', 'description' => 'Este rol es exclusivo para el manejo y administracion del sistemadesde su codigo fuente. Las acciones realizadas desde con este rol son criticas para el funcionamiento del sistema. Se debe tener mucho cuidado con la asignacion de este rol a los usuarios.']);
        $role_admin = Role::create(['name' => 'admin', 'description' => 'Este rol solo para administrar los recurtsos del sistema, gestionar registros. Las acciones realizadas desde este rol son criticas y por tal motivo se debe tomar a discrecion.']);
        $role_standard = Role::create(['name' => 'standard', 'description' => 'Este rol tiene privilegios completamente restringidos o de muy bajo nivel, solo es usado por usuarios de bajo nivel para poder realizar acciones de tema menor o visualizar informacion ']);

        $generalsystem = Module::create(['name' => 'general system']);

        $users_list = Permission::create(['name' => 'list users', 'module_id' => $generalsystem->id]);
        $create_user = Permission::create(['name' => 'create user', 'module_id' => $generalsystem->id]);
        $edit_user = Permission::create(['name' => 'edit user', 'module_id' => $generalsystem->id]);
        $detail_user = Permission::create(['name' => 'view datail user', 'module_id' => $generalsystem->id]);
        $delete_user = Permission::create(['name' => 'delete user', 'module_id' => $generalsystem->id]);

        $roles = Module::create(['name' => 'roles']);

        $createrole = Permission::create(['name' => 'create role', 'module_id' => $roles->id]);
        $editrole = Permission::create(['name' => 'edit role', 'module_id' => $roles->id]);
        $deleterole = Permission::create(['name' => 'delete role', 'module_id' => $roles->id]);
        $listroles = Permission::create(['name' => 'list roles', 'module_id' => $roles->id]);
        $viewdetailrole = Permission::create(['name' => 'view detail role', 'module_id' => $roles->id]);

        $permissions = Module::create(['name' => 'permissions']);

        $newpermission = Permission::create(['name' => 'new permission', 'module_id' => $permissions->id]);
        $editpermission = Permission::create(['name' => 'edit permission', 'module_id' => $permissions->id]);
        $deletepermision = Permission::create(['name' => 'delete permision', 'module_id' => $permissions->id]);
        $givepermission = Permission::create(['name' => 'give permission', 'module_id' => $permissions->id]);
        $revokepermission = Permission::create(['name' => 'revoke permission', 'module_id' => $permissions->id]);
        $listpermissions = Permission::create(['name' => 'list permissions', 'module_id' => $permissions->id]);
        $viewdetailpermission = Permission::create(['name' => 'view detail permission', 'module_id' => $permissions->id]);

        $permissions_root = [$users_list, $create_user, $edit_user, $detail_user, $createrole, $editrole, $deleterole, $listroles, $viewdetailrole,
                            $newpermission, $editpermission, $deletepermision, $givepermission, $revokepermission, $listpermissions, $viewdetailpermission];
        $permissions_admin = [$users_list, $create_user, $edit_user, $detail_user, $delete_user];
        $permissions_standard = [$users_list, $detail_user];

        $role_root->syncPermissions($permissions_root);
        $role_admin->syncPermissions($permissions_admin);
        $role_standard->syncPermissions($permissions_standard);
    }
}
