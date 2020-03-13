<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testThreadHasACreator()
    {
        $thread = factory('App\Thread')->create();
        $this->assertInstanceOf('App\User', $thread->creator);
    }
}
