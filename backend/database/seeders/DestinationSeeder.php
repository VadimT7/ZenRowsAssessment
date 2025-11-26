<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Seed the destinations table with data from test-data.json
     * Uses upsert to safely re-run seeder without duplicates
     */
    public function run(): void
    {
        $destinations = [
            [
                'id' => 1,
                'name' => 'Amazon S3',
                'description' => 'Turpis egestas pretium aenean pharetra magna ac placerat.',
                'icon' => 'aws',
                'color' => '#FF9900',
            ],
            [
                'id' => 2,
                'name' => 'MySQL',
                'description' => 'Accumsan sit amet nulla facilisi morbi tempus.',
                'icon' => 'mysql',
                'color' => '#00758F',
            ],
            [
                'id' => 3,
                'name' => 'MongoDB',
                'description' => 'Sagittis purus sit amet volutpat consequat mauris nunc congue nisi.',
                'icon' => 'mongodb',
                'color' => '#47A248',
            ],
            [
                'id' => 4,
                'name' => 'PostgreSQL',
                'description' => 'Neque sodales ut etiam sit amet nisl purus in mollis. Ut sem viverra aliquet eget sit.',
                'icon' => 'postgresql',
                'color' => '#336791',
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['id' => $destination['id']],
                $destination
            );
        }
    }
}

