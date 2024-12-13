<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Define the ratings relationship
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Define the author relationship
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Define the category relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
