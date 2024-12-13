<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // Define the relationship with Book
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
