<?php

namespace Tests\Unit;

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
            'subject_type' => 'thread'
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
    }
}
