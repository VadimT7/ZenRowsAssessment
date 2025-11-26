<?php

namespace Database\Seeders;

use App\Models\Origin;
use Illuminate\Database\Seeder;

class OriginSeeder extends Seeder
{
    /**
     * Seed the origins table with data from test-data.json
     * Uses upsert to safely re-run seeder without duplicates
     */
    public function run(): void
    {
        $origins = [
            [
                'id' => 1,
                'name' => 'Zillow',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.',
                'icon' => 'zillow',
                'color' => '#1277E1',
            ],
            [
                'id' => 2,
                'name' => 'Redfin',
                'description' => 'Odio ut sem nulla pharetra diam sit. Ornare aenean euismod elementum nisi quis eleifend.',
                'icon' => 'redfin',
                'color' => '#A02021',
            ],
            [
                'id' => 3,
                'name' => 'Trulia',
                'description' => 'Amet consectetur adipiscing elit pellentesque habitant.',
                'icon' => 'trulia',
                'color' => '#7B68EE',
            ],
            [
                'id' => 4,
                'name' => 'Realtor',
                'description' => 'Arcu cursus euismod quis viverra nibh cras pulvinar mattis.',
                'icon' => 'realtor',
                'color' => '#D92228',
            ],
        ];

        foreach ($origins as $origin) {
            Origin::updateOrCreate(
                ['id' => $origin['id']],
                $origin
            );
        }
    }
}

