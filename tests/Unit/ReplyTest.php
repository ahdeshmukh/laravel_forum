<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase; // https://stackoverflow.com/questions/36421287/laravel-5-2-unable-to-locate-factory-with-name-default

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_reply_has_an_owner()
    {
        $reply = factory('App\Reply')->create();
        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
