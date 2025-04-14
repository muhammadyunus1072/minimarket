<?php

namespace Database\Seeders\User;

use App\Permissions\PermissionHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create role
        $role = Role::create(['name' => config('template.admin_role')]);
        foreach (PermissionHelper::ACCESS_TYPE_ALL as $access => $types) {
            foreach ($types as $type) {
                $role->givePermissionTo(PermissionHelper::transform($access, $type));
            }
        }
        $role = Role::create(['name' => config('template.superadmin_role')]);
        foreach (PermissionHelper::ACCESS_TYPE_ALL as $access => $types) {
            foreach ($types as $type) {
                $role->givePermissionTo(PermissionHelper::transform($access, $type));
            }
        }
        $role = Role::create(['name' => config('template.cashier_role')]);
        $role = Role::create(['name' => config('template.member_role')]);
    }
}
