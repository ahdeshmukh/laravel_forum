<?php

namespace App;

class Favorite extends ForumBaseModel
{
    protected $guarded = [];

    public function favorited()
    {
        return $this->morphTo();
    }
}
