<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;

class RatingController extends Controller
{
    public function create()
    {
        $authors = Author::with('books')->limit(50)->get();
        return view('ratings.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.index')->with('success', 'Rating submitted successfully');
    }

    public function getBooks($author_id)
    {
        $books = Book::where('author_id', $author_id)->get();
        return response()->json($books);
    }

}
