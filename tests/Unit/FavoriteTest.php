<?php

namespace Tests\Unit;

use App\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_favorite_may_belong_to_a_reply()
    {
        // create a reply
        $reply = create('App\Reply');

        // sign in and favorite the reply
        $this->signIn();
        $reply->favorites();

        // get the favorite for the reply
        $favorite = $reply->favorite();

        // check if the favorite belongs to the above reply
        $this->assertEquals($favorite->favorited->id, $reply->id);
        $this->assertEquals($favorite->favorited->body, $reply->body);
    }
}
