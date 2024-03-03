<?php

namespace Database\Seeders;

use App\Models\IndustryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industryType = [
            'Information Technology',
            'Hotel/Restaurant',
            'Pharmaceuticals',
            'Logistics/Transportation',
            'NGO/Development'
        ];

        foreach ($industryType as $type) {
            IndustryType::create([
                'industry_type' => $type,
                'status' => 'active',
            ]);
        }
    }

}
