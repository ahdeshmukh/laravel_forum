<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends ForumBaseModel
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }
}
