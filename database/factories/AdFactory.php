<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ad::class;
    public function definition(): array
    {
        $title = fake()->sentence(3);
        return [
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title.'-'.Str::random(6)),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(100, 100000),
            'location' => fake()->city(),
            'status' => 'published',
        ];
    }
}
