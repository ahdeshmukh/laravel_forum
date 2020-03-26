<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    // https://laravel.com/docs/7.x/eloquent#mass-assignment
    protected $guarded = [];

    public function path()
    {
        //return '/threads/'. $this->id;
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
        // to arrange latest replies on top
        // return $this->hasMany(Reply::class)->latest();
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
