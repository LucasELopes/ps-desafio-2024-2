<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{

    private $categoriasLivros = [
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
        foreach($this->categoriasLivros as $categoria) {
            Categorie::create(['nome' => $categoria]);
        }
    }
    
}
