<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'Superadmin',
            'mobile_number' => 8989898989,
            'email' => 'superadmin@gmail.com',
            'account_status' => 'activated',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $role = Role::where('name', 'superadmin')->first();
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $superadmin->assignRole([$role->id]);

        // $permissions = Permission::all();
        // $superadmin->syncPermissions($permissions);

        $employerRole = Role::where('name', 'employer')->first();
         // Do not assign any permissions to the employer role

        $candidateRole = Role::where('name', 'candidate')->first();
        // Do not assign any permissions to the candidate role


    }
}
