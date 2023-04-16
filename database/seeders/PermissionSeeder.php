<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_list = [
            'user', 'role',
        ];

        $other_permissions = [
            'report' => [
                ['user'],
            ],
            'miscellaneous' => [
                [
                    'General Setting' => 'general_setting', 
                    'Backup Database' => 'database_backup',
                ]
            ],
        ];

        $role = Role::where('name', 'Super Admin')->first();
        $role = Role::find($role->id);
        foreach($permission_list as $item) {
            foreach(['index', 'create', 'update', 'destroy'] as $sub) {
                $permission_ = Permission::create(['name' => $item.'-'.$sub]);
                $role->givePermissionTo($permission_);
            }
        }

        foreach($other_permissions as $key => $item) {
            foreach($item as $sub) {
                foreach($sub as $_sub) {
                    $permission_ = Permission::create(['name' => $key.'-'.$_sub]);
                    $role->givePermissionTo($permission_);
                }                
            }
        }
    }
}
