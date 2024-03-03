<?php

namespace Database\Seeders;

use App\Models\TeamSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamSize = [
            'Only Me',
            '0-10 Member',
            '10-20 Member',
            '20-30 Member',
            '50+ Member',

        ];

        foreach ($teamSize as $size) {
            TeamSize::create([
                'team_size' => $size,
                'status' => 'active',
            ]);
        }
    }
}
