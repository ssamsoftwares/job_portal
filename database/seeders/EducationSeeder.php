<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
     {
         $education = [
             'High School',
             'Intermediate',
             'Bachelor Degree',
             'Master Degree',
             'Graduated',
             'PhD',
             'Any',

         ];

         foreach ($education as $edu) {
             Education::create([
                 'education' => $edu,
                 'status' => 'active',
             ]);
         }
     }




}
