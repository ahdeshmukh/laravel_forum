<?php

namespace Tests\Feature;

use App\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageThreadsTest extends TestCase
{

    use RefreshDatabase;

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_unauthenticated_users_cannot_create_new_forum_threads()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());
    }

    public function test_unauthenticated_users_cannot_see_create_thread_page()
    {
        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function test_a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 9999])
            ->assertSessionHasErrors('channel_id');
    }

    public function test_authorized_users_can_delete_threads()
    {
        $this->signIn();

        // create a thread
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        // create a few replies to the thread
        $reply1 = create('App\Reply', ['thread_id' => $thread->id]);
        $reply2 = create('App\Reply', ['thread_id' => $thread->id]);

        // favorite both the replies
        $this->post("/replies/{$reply1->id}/favorites");
        $this->post("/replies/{$reply2->id}/favorites");

        // delete the thread
        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);

        // ensure thread no longer exists in the DB
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);

        // ensure replies to the thread no longer exist in the DB
        $this->assertDatabaseMissing('replies', ['thread_id' => $thread->id]);

        // ensure favorites for the replies no longer exist in the DB
        $this->assertDatabaseMissing('favorites', ['favorited_type' => 'reply', 'favorited_id' => $reply1->id]);
        $this->assertDatabaseMissing('favorites', ['favorited_type' => 'reply', 'favorited_id' => $reply2->id]);


        // ensure that when a thread is deleted, it's corresponding activity is deleted
        // if the deleted thread has replies which are also deleted, ensure the corresponding activity for replies is deleted

        // in short for this test, we have to make sure there are 0 activity records
        $this->assertEquals(0, Activity::count());

    }

    public function test_unauthorized_user_cannot_delete_threads()
    {
        $thread = create('App\Thread');

        $this->withExceptionHandling();

        $this->delete($thread->path())
            ->assertRedirect('/login');

        $this->signIn();
        $this->delete($thread->path())
            ->assertStatus(403);
    }



    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
