<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    // https://laravel.com/docs/7.x/eloquent#mass-assignment
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
