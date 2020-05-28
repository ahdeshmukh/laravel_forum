<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Reply;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Channel $channel, Thread $thread)
    {
        $this->validate(request(), [
           'body' => 'required'
        ]);

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back()->with('flash', 'Your reply has been posted.');
    }


    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        return back()->with('flash', 'Reply deleted');
    }
}
