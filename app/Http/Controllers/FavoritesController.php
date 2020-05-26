<?php

namespace App\Http\Controllers;

use App\Reply;

class FavoritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->favorite();

        // redirecting to page from where Favorite button was clicked
        return back()->with('flash', 'You favorited a reply');

    }
}
