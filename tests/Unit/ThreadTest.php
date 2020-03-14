<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    public function testThreadCanHaveReplies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function testThreadHasACreator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    public function testReplyCanBeAddedToAThread()
    {
        $this->thread->addReply([
            'body' => 'Foo Bar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
