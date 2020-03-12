<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBrowseThreads()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }
}
