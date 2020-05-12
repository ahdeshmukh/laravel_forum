<?php

namespace App;

class Activity extends ForumBaseModel
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }
}
