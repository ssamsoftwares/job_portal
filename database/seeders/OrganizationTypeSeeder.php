<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $organizationTypes = [
            'Semi Government',
            'Public',
            'Private',
            'NGO',
            'Agencies'
        ];

        foreach ($organizationTypes as $type) {
            OrganizationType::create([
                'organization_type' => $type,
                'status' => 'active',
            ]);
        }
    }
}
