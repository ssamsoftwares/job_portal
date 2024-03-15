<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'html',
            'css',
            'js',
            'php',
            'laravel',
            'mysql',
            'nodejs',
            'WordPress',
            'SEO'
        ];

        foreach ($skills as $skill) {
            Skill::create([
                'skill' => $skill,
                'status' => 'active',
            ]);
        }
    }
}
