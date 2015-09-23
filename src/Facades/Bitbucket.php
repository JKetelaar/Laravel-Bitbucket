<?php
/**
 * @author JKetelaar
 */
namespace JKetelaar\Bitbucket\Facades;

use Illuminate\Support\Facades\Facade;

class Bitbucket extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'bitbucket';
    }
}
