<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;


class AuthorController extends Controller
{
    public function top()
    {
        $authors = Author::withCount(['books as voters' => function ($query) {
            $query->join('ratings', 'books.id', '=', 'ratings.book_id')
                  ->select(\DB::raw('count(ratings.id)')) // count the number of ratings (voters)
                  ->groupBy('books.author_id');
        }])
        ->orderBy('voters', 'desc') // Now ordering by 'voters' instead of 'voters_count'
        ->limit(10)
        ->get();
    
        return view('authors.top', compact('authors'));
    }
}
