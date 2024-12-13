<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;    

class BookController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10); // Default to 10 items per page
        $search = $request->input('search', null);

        $books = Book::with('author', 'category')
            ->withCount(['ratings as average_rating' => function ($query) {
                $query->select(\DB::raw('avg(rating)'));
            }, 'ratings as voters' => function ($query) {
                $query->select(\DB::raw('count(*)'));
            }])
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhereHas('author', function ($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('category', function ($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%');
                      });
            })
            ->orderBy('average_rating', 'desc')
            ->paginate($limit); // Use paginate instead of limit

        return view('books.index', compact('books', 'limit'));
    }
}
