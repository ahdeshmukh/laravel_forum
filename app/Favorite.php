<?php

namespace App;

use App\Traits\RecordsActivity;

class Favorite extends ForumBaseModel
{
    use RecordsActivity;

    protected $guarded = [];

    public function favorited()
    {
        return $this->morphTo();
    }
}
