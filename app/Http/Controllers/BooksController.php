<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $booksQuery = Books::when($title, fn($query, $title) => $query->title($title));

        $booksQuery = match ($filter) {
            'popular_last_month' => $booksQuery->popularLastMonth(),
            'popular_last_6months' => $booksQuery->popularLast6Months(),
            'highest_rated_last_month' => $booksQuery->highestRatedLastMonth(),
            'highest_rated_last_6months' => $booksQuery->highestRatedLast6Months(),
            default => $booksQuery->latest()->withAvgRating()->withReviewsCount(),
        };

        $books = $booksQuery->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();

        return view('books.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Books $book)
    {
        //show the form
        return view('books.create',[
            'book' => $book,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Books $book)
    {
        //validation
        $request->validate([
            'review' => ['required'],
            'rating' => ['required'],
        ]);

        //store database
        Review::create([
            'books_id' => $book->id,
            'rating' => request('rating'),
            'review' => request('review'),
        ]);
        //redirect to review page
        return redirect('/books/' . $book->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {
        $reviews = Review::where('books_id', $book->id)->latest()->get();
        $totalReviews = $reviews->count(); // Count total reviews
        $averageRating = $reviews->avg('rating'); // Calculate average rating

        return view('books.show', [
            'book' => $book,
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'averageRating' => $averageRating,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBooksRequest $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $books)
    {
        //
    }
}
