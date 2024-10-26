<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'name' => fake()->title(),
            'author' => fake()->name(),
            'release_date' => fake()->date('Y-m-d', 'now'),
            'image' => fake()->title().'png',
            'quantity' => fake()->numberBetween(0, 100),
        ];

    }
}
