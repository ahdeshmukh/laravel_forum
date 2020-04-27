<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = create('App\User');
    }

    /**
     * Unauthenticated user cannot see user profile page
     * Should be redirected to login page
     */
    public function test_only_authenticated_user_can_see_profile_page()
    {
        $this->withExceptionHandling()->get("/profiles/{$this->user->id}")
            ->assertRedirect("/login");
    }

    /**
     * A user has a profile
     */
    public function test_a_user_has_a_profile()
    {
        //$user = $this->user;
        $this->signIn($this->user);

        $this->get("/profiles/{$this->user->id}")
            ->assertSee($this->user->first_name . ' ' . $this->user->last_name);
    }


    public function test_a_user_profile_displays_threads_created_by_the_user()
    {
        $this->signIn($this->user);
        $thread = create('App\Thread', ['user_id' => $this->user->id]);

        $this->get("/profiles/{$this->user->id}")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}
