<?php

namespace Database\Factories;

use App\Models\Categorie;
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
            'data_de_lancamento' => fake()->date('Y-m-d', 'now'),
            'imagem' => fake()->title().'png',
            'categoria_id' => Categorie::all()->random(),
            'quantidade' => fake()->numberBetween(0, 100),
        ];

    }
}
