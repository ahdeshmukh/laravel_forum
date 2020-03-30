<?php

namespace App\Filters;

class ThreadFilters extends Filters
{

    protected $filters = ['userId', 'popular'];

    /**
     * Filter the query by given userId
     * @param $userId
     * @return mixed
     */
    protected function userId($userId)
    {
        return $this->builder->where('user_id', $userId);
    }

    /**
     * Filter the query which has most replies desc
     * @return mixed
     */
    protected function popular()
    {
        // if we absolutely need to remove order by column, uncomment below line
        //$this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('replies_count', 'desc');
    }
}
