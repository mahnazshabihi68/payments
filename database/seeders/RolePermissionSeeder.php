<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert(
            [
                ['name' => 'user', 'guard_name' => 'user'],
                ['name' => 'admin', 'guard_name' => 'admin']
            ]);

        $permissionsByRole = [
            'user' => ['payment'],
            'admin' => ['confirmationPayment'],
        ];

        $insertPermissions = fn($role) => collect($permissionsByRole[$role])
            ->map(fn($name) => DB::table('permissions')->insertGetId(['name' => $name, 'guard_name' => $name]))
            ->toArray();

        $permissionIdsByRole = [
            'user' => $insertPermissions('user'),
            'admin' => $insertPermissions('admin'),
        ];

        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();

            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ])->toArray()
                );
        }
    }
}
