<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nome'
    ];
    
    public function books() {
        return $this->hasMany(Book::class, 'categoria_id', 'id');
    }

}
