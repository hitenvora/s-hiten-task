<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\JobCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(JobCategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
