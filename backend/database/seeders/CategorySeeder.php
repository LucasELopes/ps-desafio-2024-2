<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    private $categories = [
        'Ficção Científica',
        'Romance',
        'Fantasia',
        'Mistério',
        'Terror',
        'História',
        'Biografia',
        'Autoajuda',
        'Filosofia',
        'Psicologia',
        'Negócios',
        'Tecnologia',
        'Ciência',
        'Poesia',
        'Policial',
        'Aventura',
        'Humor',
        'Infantil',
        'Jovem Adulto',
        'Saúde e Bem-estar',
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->categories as $category) {
            Category::create(['name' => $category]);
        }
    }
    
}
