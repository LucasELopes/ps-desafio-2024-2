<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $table = "book_category";
    public $incrementing = false;
    protected $primaryKey = [
        'book_id',
        'category_id'
    ];
    
    protected $fillable = [
        'book_id',
        'category_id'
    ];

}
