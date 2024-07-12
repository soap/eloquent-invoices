<?php

namespace Soap\Eloquent\Invoice\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soap\Eloquent\Invoice\Invoice
 */
class Invoice extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Soap\Eloquent\Invoice\Invoice::class;
    }
}
