<?php

function create($class, $attributes = [], $number = null)
{
    return factory($class, $number)->create($attributes);
}

function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}
