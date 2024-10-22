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
        'quantidade',
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    protected static function booted() {
        self::deleted(function (Book $book){
            try {
                $imagemNome = explode('/', $book['imagem']);
                Storage::disk('public')->deleteDirectory('books/'.$imagemNome[1]);
            } catch (\Throwable $th) {
            }
        });
    }

}
