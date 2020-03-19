<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Given that a user is authenticated and a thread exists
     * When a user adds a reply to the thread, it should be visible on the page
     * @return void
     */
    public function test_auth_user_may_participate_in_forum_threads()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply');

        // when a user adds a reply to the thread
        $this->post("{$thread->path()}/replies", $reply->toArray());

        // a reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    public function test_unauthorized_users_cannot_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/some-channel/1/replies', []);
    }

    public function test_a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post("{$thread->path()}/replies", $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
