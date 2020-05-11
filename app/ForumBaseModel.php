<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumBaseModel extends Model
{
    public function getId()
    {
        return $this->id;
    }
}
