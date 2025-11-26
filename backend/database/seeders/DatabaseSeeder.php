<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Loads origins and destinations from test-data.json
     */
    public function run(): void
    {
        $this->call([
            OriginSeeder::class,
            DestinationSeeder::class,
        ]);
    }
}

