<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    public function test_user_can_see_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    public function test_user_can_see_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    public function test_user_can_see_replies_to_a_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    public function test_user_can_see_who_created_thread()
    {
        // on threads page
        $this->get('/threads')
            ->assertSee('Posted by '.$this->thread->creator->first_name.' '.$this->thread->creator->last_name);

        // on individual thread page
        $this->get($this->thread->path())
            ->assertSee('Posted by '.$this->thread->creator->first_name.' '.$this->thread->creator->last_name);
    }
}
