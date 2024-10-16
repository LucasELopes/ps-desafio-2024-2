<?php

namespace Database\Factories;

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
            'nome' => fake()->title(),
            'autor' => fake()->name(),
            'data_de_lancamento' => fake()->date('Y-m-d', '1 year'),
            'imagem' => fake()->title() . '.png',
            'categoria' => fake()->numberBetween(0, 20),
            'quantidade' => fake()->numberBetween(0, 100),
        ];
    }
}
