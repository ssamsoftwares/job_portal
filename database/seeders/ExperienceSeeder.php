<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


     public function run(): void
     {
         $experiences = [
             'Freshar',
             '0-1 Year',
             '01-02 Years',
             '4+ Years',
             '10+ Years',

         ];

         foreach ($experiences as $ex) {
             Experience::create([
                 'experiences' => $ex,
                 'status' => 'active',
             ]);
         }
     }

     
}
