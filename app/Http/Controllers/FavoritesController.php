<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Reply;

class FavoritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        /*return \DB::table('favorites')->insert([
            'user_id' => auth()->id(),
            'favorited_id' => $reply->id,
            'favorited_type' => get_class($reply)
        ]);*/

        return $reply->favorite();

        //return $response;

        /*return Favorite::create([
            'user_id' => auth()->id(),
            'favorited_id' => $reply->id,
            'favorited_type' => 'replies'//get_class($reply)
        ]);*/

        /*if($response) {
            return json_encode(true);
        }

        return json_encode(false);*/
    }
}
