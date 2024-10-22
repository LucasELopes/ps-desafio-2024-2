<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nome'
    ];
    
    public function books() {
        return $this->belongsToMany(Book::class, 'book_category', 'category_id', 'book_id');
    }
    
}
