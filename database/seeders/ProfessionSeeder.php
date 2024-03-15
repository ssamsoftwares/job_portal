<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profession = [
            'Farmer',
            'Engineer',
            'Driver',
        ];

        foreach ($profession as $pro) {
            Profession::create([
                'profession' => $pro,
                'status' => 'active',
            ]);
        }
    }
}
