<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    // https://laravel.com/docs/7.x/eloquent#mass-assignment
    protected $guarded = [];

    public $with = ['creator', 'channel'];

    // Laravel knows this function needs to be invoked automatically
    protected static function boot()
    {
        parent::boot();

        // adding count of replies to all thread queries
        // https://laravel.com/docs/5.8/eloquent#global-scopes
        static::addGlobalScope('replyCount', function($builder) {
            $builder->withCount('replies');
        });
    }

    public function path()
    {
        //return '/threads/'. $this->id;
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    // read about query scope
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
