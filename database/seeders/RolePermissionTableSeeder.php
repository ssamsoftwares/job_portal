<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                "name" => "superadmin"
            ],
            [
                "name" => "employer"
            ],
            [
                "name" => "candidate"
            ],
        ];

        $permissions = [
            ["name" => "role-list"],
            ["name" => "role-view"],
            ["name" => "role-create"],
            ["name" => "role-edit"],
            ["name" => "role-delete"],
        ];


        foreach ($roles as $role) {
            Role::create($role);
        }

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

    }
}
