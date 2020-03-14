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
    public function testAuthUserMayParticipateInForumThreads()
    {
        $this->be(factory('App\User')->create()); // create a user and authenticate using be()
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();

        // when a user adds a reply to the thread
        $this->post($thread->path().'/replies', $reply->toArray());

        // a reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    public function testUnauthorizedUsersCannotAddReplies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/1/replies', []);
    }
}
