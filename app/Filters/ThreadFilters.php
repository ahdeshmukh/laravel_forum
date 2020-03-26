<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ThreadFilters
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        if(!$this->request->user_id) {
            return $builder;
        }

        return $builder->where('user_id', $this->request->user_id);

    }
}
