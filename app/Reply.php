<?php

namespace App;

use App\Traits\Favoritable;
use App\Traits\RecordsActivity;

class Reply extends ForumBaseModel
{
    use Favoritable, RecordsActivity;

    // https://laravel.com/docs/7.x/eloquent#mass-assignment
    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Reply $reply) {
            //$reply->favorites()->delete();

            // have to use foreach or else deleting for deep nesting does not work. hence commenting above line
            // https://stackoverflow.com/questions/45075845/automatically-deleting-nested-related-rows-in-laravel-5-4-eloquent-orm
            foreach ($reply->favorites as $favorites) {
                $favorites->delete();
            }
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

}
