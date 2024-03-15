<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
     {
         $jobtype = [
             'Full time',
             'Part time',
             'Intern',
             'Contractual',
             'Freelance',

         ];

         foreach ($jobtype as $type) {
             JobType::create([
                 'job_type' => $type,
                 'status' => 'active',
             ]);
         }
     }


}
