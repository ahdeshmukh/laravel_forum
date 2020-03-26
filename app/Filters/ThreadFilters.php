<?php

namespace App\Filters;

class ThreadFilters extends Filters
{

    protected $filters = ['userId'];

    protected function userId($userId)
    {
        return $this->builder->where('user_id', $userId);
    }
}
