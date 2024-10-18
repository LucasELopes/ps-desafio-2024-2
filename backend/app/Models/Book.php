<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Book extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'books';

    protected $fillable = [
        'nome',
        'autor',
        'data_de_lancamento',
        'imagem',
        'categoria_id',
        'quantidade'
    ];

    public function categorie() {
        return $this->belongsTo(Categorie::class, 'categoria_id', 'id');
    }

    protected static function booted() {
        self::deleted(function (Book $book){
            try {
                $imagemNome = explode('books/', $book['imagem']);
                Storage::disk('public')->delete('books/'.$imagemNome[1]);
            } catch (\Throwable $th) {
            }
        });
    }

}
