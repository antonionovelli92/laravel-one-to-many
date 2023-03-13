<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Rircodati l'ordine, prima le entità forti!
        $this->call([UserSeeder::class, Category::class, ProjectSeeder::class, Category::class]);
    }
}
