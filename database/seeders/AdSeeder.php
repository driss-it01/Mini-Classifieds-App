<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::count() === 0) $this->call(CategorySeeder::class);
        Ad::factory(30)->create();
    }
}
