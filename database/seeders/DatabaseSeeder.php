<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Education;
use App\Models\Experience;
use App\Models\JobType;
use App\Models\TeamSize;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolePermissionTableSeeder::class,
            SuperadminSeeder::class,
            OrganizationTypeSeeder::class,
            IndustryTypeSeeder::class,
            TeamSizeSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            JobCategorySeeder::class,
            JobRoleSeeder::class,
            LanguageSeeder::class,
            ProfessionSeeder::class,
            SalaryTypeSeeder::class,
            SkillSeeder::class,
            TagSeeder::class,
        ]);


    }
}
