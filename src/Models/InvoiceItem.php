<?php

namespace Soap\Eloquent\Invoices\Models;

use Finller\Money\MoneyCast;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        /**
         * This cast will be forwarded to the class defined in config at invoices.money_cast
         */
        'unit_price' => MoneyCast::class.':currency',
        'unit_tax' => MoneyCast::class.':currency',
        'metadata' => AsArrayObject::class,
        'tax_percentage' => 'float',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(config('invoices.model_invoice'));
    }
}
