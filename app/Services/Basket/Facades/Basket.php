<?php

namespace App\Services\Basket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getProducts()
 */
class Basket extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Basket\Basket';
    }
}