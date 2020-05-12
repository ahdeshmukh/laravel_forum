<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_on_successful_login_redirect_to_previous_page()
    {
        // create a user
        factory('App\User')->create([
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password')
        ]);

        // create a thread
        $thread = create('App\Thread');

        // visit the thread page
        $this->get($thread->path());

        // now visit the login page. Same as hitting sign in link to post a reply
        $this->get('/login');

        // login and make sure we are redirected to the threads page
        $this->post('/login', ['email' => 'john.doe@example.com', 'password' => 'password'])
            ->assertRedirect($thread->path());
    }
}
