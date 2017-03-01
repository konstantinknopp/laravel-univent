<?php

namespace Unikat\Univent\Facades;

use Illuminate\Support\Facades\Facade;

class Univent extends Facade
{
    
    /**
     * Get the registered name of the component
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'univent';
    }
}