<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'price' => fake()->numberBetween(10000, 100000),
            'stock' => fake()->numberBetween(10, 100),
            'image' => null,
            'category_id' => Category::inRandomOrder()->value('id'),
        ];
    }
}