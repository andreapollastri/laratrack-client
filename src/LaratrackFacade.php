<?php

namespace Andr3a\Laratrack;

use Illuminate\Support\Facades\Facade;

class LaratrackFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laratrack';
    }
}
