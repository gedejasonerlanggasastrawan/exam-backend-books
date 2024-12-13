<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // Add the fields that can be mass-assigned
    protected $fillable = [
        'book_id',  // Allow mass assignment of book_id
        'rating',   // Add other fields that need mass assignment as necessary
    ];
    
}
