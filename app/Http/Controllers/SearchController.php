<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class SearchController extends Controller
{
    public function __invoke()
    {
        
        $books = Books::where('title', 'LIKE', '%' . request('search') . '%')->get();
        return view('search', [
            'books' => $books
        ]);
    }
}
