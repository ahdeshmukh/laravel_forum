<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanSeeThreads()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }

    public function testUserCanSeeASingleThread()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads/'.$thread->id);
        $response->assertSee($thread->title);
    }
}
