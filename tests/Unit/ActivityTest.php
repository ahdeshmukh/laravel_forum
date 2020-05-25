<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Activity;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_records_an_activity_when_thread_is_created()
    {
        $this->signIn();

        $thread = create('App\Thread');

        // this record is created when a thread is created above
        $activity = Activity::first();

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'thread',
            'id' => 1
        ]);

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    public function test_it_records_an_activity_when_a_reply_is_created()
    {
        $this->signIn();

        create('App\Reply');

        // we expect 2 activities, 1 for creating a reply and 1 for creating a thread
        // reason being, a thread is auto created when a reply is created
        // Ref ReplyFactory.php

        $this->assertEquals(2, Activity::count());

        $this->assertDatabaseHas('activities', [
            'type' => 'created_reply',
            'user_id' => auth()->id(),
            'subject_id' => 1,
            'subject_type' => 'reply',
            'id' => 2
        ]);
    }

    public function test_it_fetches_a_feed_for_any_user()
    {
        // Given we have a thread
        // And another thread from a week ago
        // when we fetch the user feed
        // then it should be returned in the correct format

        $this->signIn();

        create('App\Thread', ['user_id' => auth()->id()]);

        create('App\Thread', [
            'user_id' => auth()->id(),
            'created_at' => Carbon::now()->subWeek()
        ]);

        // If a thread is created a week ago, so is the activity
        // to simulate it, getting the first user activity and changing it's created at to a week ago

        auth()->user()->activity()->first()->update([
            'created_at' => Carbon::now()->subWeek()
        ]);


        $feed = Activity::feed(auth()->user(), 50);

        $this->assertTrue($feed->keys()->contains(
           Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}
