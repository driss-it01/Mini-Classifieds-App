<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'Electronics','slug'=>'electronics'],
            ['name'=>'Vehicles','slug'=>'vehicles'],
            ['name'=>'Real Estate','slug'=>'real-estate'],
            ['name'=>'Jobs','slug'=>'jobs'],
            ['name'=>'Home & Garden','slug'=>'home-garden'],
        ];
        foreach ($data as $c) Category::firstOrCreate(['slug'=>$c['slug']], $c);
    }
}
