<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
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

    public function test_user_sees_404_for_thread_for_channel_that_does_not_exist()
    {
        // here the channel slug is wrong on purpose
        $response = $this->withExceptionHandling()->get("/threads/some-channel/{$this->thread->id}");
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function test_user_can_see_replies_to_a_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    public function test_user_can_see_who_created_thread()
    {
        // faced this https://laracasts.com/discuss/channels/testing/phpunit-fails-or-passes-randomly
        $this->get($this->thread->path())
            ->assertSee(e($this->thread->creator->first_name.' '.$this->thread->creator->last_name));
    }

    public function test_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/'.$channel->slug)
            ->assertSee(e($threadInChannel->title))
            ->assertDontSee(e($threadNotInChannel->title));
    }

    public function test_a_user_can_filter_threads_by_userId()
    {
        $this->signIn(create('App\User'));

        $userId = auth()->id();

        $threadByAuthUser = create('App\Thread', ['user_id' => $userId]);
        $threadNotByAuthUser = create('App\Thread');

        $this->get('/threads?userId='.$userId)
            ->assertSee($threadByAuthUser->title)
            ->assertDontSee($threadNotByAuthUser->title);
    }

    public function test_a_user_can_sort_threads_by_popularity()
    {
        // Given we have 3 threads
        // with 2 replies, 3 replies and 0 replies
        // when I filter all threads by popularity
        // then they should return from most replies to least replies

        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithZeroReplies = $this->thread;

        // returning json since it is easier to find order in array
        $response = $this->getJson('/threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
