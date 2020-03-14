<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    // https://laravel.com/docs/7.x/eloquent#mass-assignment
    protected $guarded = [];

    public function path()
    {
        return '/threads/'. $this->id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}
