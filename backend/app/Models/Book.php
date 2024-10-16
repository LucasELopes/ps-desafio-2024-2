<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'books';

    protected $fillable = [
        'nome',
        'autor',
        'data_de_lancamento',
        'imagem',
        'categoria',
        'quantidade'
    ];
}
