<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


     public function run(): void
     {
         $langauage = [
             'English',
             'Hindi',

         ];

         foreach ($langauage as $lang) {
             Language::create([
                 'language' => $lang,
                 'status' => 'active',
             ]);
         }
     }

}
