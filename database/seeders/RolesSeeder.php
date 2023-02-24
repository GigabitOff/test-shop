<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    protected $permissions = [
        'order_index', 'order_view', 'order_create', 'order_update', 'order_delete',
        'manager_index', 'manager_view', 'manager_create', 'manager_update', 'manager_delete',
        'customer_index', 'customer_view', 'customer_create', 'customer_update', 'customer_delete',
        'manage_managers',
        'api_access',
    ];

    protected $roles = [
        'admin' => [
            'order_index', 'order_view', 'order_create', 'order_update', 'order_delete',
            'manager_index', 'manager_view', 'manager_create', 'manager_update', 'manager_delete',
            'customer_index', 'customer_view', 'customer_create', 'customer_update', 'customer_delete',
            'manage_managers',
            'api_access',
        ],
        'director' => [
            'order_index', 'order_view',
            'manager_index', 'manager_view',
        ],
        'manager' => [
            'order_index', 'order_view', 'order_create', 'order_update', 'order_delete',
            'customer_index', 'customer_view', 'customer_create', 'customer_update', 'customer_delete',
        ],
        'head_manager' => [
            'order_index', 'order_view', 'manager_index', 'manager_view', 'manage_managers'
        ],
        
        'legal' => [
            'order_index', 'order_view', 'order_create', 'order_update', 'order_delete',
        ],
        'simple' => [
            'order_index', 'order_view', 'order_create', 'order_update', 'order_delete',
        ],
        'api_manager' => [
            'api_access'
        ],
        'unregistered' => [
            'order_index', 'order_view', 'order_create', 'order_update', 'order_delete',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::count() > 0){
            return;
        }

        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('roles')->truncate();


        foreach ($this->permissions as $permission) {
            Permission::create([
                'name' => $permission,
//                'guard_name' => 'web',
            ]);
        }

        foreach ($this->roles as $role_name => $permissions) {
            $role = Role::create(['name' => $role_name]);
            $role->givePermissionTo($permissions);
        }
    }
}
