<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    // https://scotch.io/tutorials/cleaner-laravel-controllers-with-route-model-binding
    public function getRouteKeyName() {
        return 'slug';
    }
}
