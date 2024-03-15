<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobCategory = [
            'Engineer/Architects',
            'Garments/Textile',
            'Design/Creative',
            'Hospitality/ Travel/ Tourism',
            'IT & Telecommunication',
            'Medical/Pharma',
            'Driving/Motor Technician',
            'Law/Legal',
            'Others',
        ];

        foreach ($jobCategory as $cat) {
            JobCategory::create([
                'category' => $cat,
                'status' => 'active',
            ]);
        }
    }
}
