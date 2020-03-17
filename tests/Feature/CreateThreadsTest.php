<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{

    use RefreshDatabase;

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        $this->be(factory('App\User')->create());
        $thread = factory('App\Thread')->make();
        $this->post('/threads', $thread->toArray());
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_an_unauthenticated_users_cannot_create_new_forum_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = factory('App\Thread')->make();
        $this->post('/threads', $thread->toArray());
    }
}
