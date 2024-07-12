<?php

namespace Soap\Eloquent\Invoices\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soap\Eloquent\Invoices\Models\Invoice
 */
class Invoice extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Soap\Eloquent\Invoices\Models\Invoice::class;
    }
}
