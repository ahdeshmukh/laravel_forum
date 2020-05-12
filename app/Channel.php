<?php

namespace App;

class Channel extends ForumBaseModel
{
    // https://scotch.io/tutorials/cleaner-laravel-controllers-with-route-model-binding
    public function getRouteKeyName() {
        return 'slug';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
