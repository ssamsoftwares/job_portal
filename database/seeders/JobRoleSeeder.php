<?php

namespace Database\Seeders;

use App\Models\JobRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobRole = [
            'Team Leader',
            'Manager',
            'Assistant Manager',
            'Executive',
            'Director',
            'Administrator',
        ];

        foreach ($jobRole as $role) {
            JobRole::create([
                'job_role' => $role,
                'status' => 'active',
            ]);
        }
    }
}
