<?php

namespace App\Http\Controllers;

use App\Favorite;
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

         return back();

    }

    public function destroy(Reply $reply)
    {
        $reply->unfavorite();
    }
}
