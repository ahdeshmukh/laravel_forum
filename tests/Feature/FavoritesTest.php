<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;


    public function test_guests_cannot_favorite_anything()
    {
        $reply = create('App\Reply');

        $this->withExceptionHandling()
            ->post("/replies/{$reply->id}/favorites")
            ->assertRedirect('/login');
    }


    public function test_an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply'); // this automatically creates thread. refer ReplyFactory.php

        /*$this->post("/replies/{$reply->id}/favorites")
            ->assertStatus(201)
            ->assertJson([
            'user_id' => auth()->id(),
            'favorited_id' => 1,
            'favorited_type' => 'replies',
        ]);*/

        $this->post("/replies/{$reply->id}/favorites");

        $this->assertCount(1, $reply->favorites);
    }

    public function test_an_authenticated_user_can_favorite_a_reply_only_once()
    {
        $this->signIn();

        $reply = create('App\Reply');

        try {
            $this->post("/replies/{$reply->id}/favorites");
            $this->post("/replies/{$reply->id}/favorites");
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert same record twice');
        }

        $this->assertCount(1, $reply->favorites);
    }

}
