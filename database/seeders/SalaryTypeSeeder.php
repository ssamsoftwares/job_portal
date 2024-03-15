<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
     {
         $salaryType = [
             'Monthly',
             'Project Basis',
             'Hourly',
             'Yearly',
         ];

         foreach ($salaryType as $type) {
             Salary::create([
                 'salary_type' => $type,
                 'status' => 'active',
             ]);
         }
     }


}
