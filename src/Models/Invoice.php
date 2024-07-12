<?php

namespace Soap\Eloquent\Invoices\Models;

use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model implements Attachable
{
    use HasFactory;

    public static function booted()
    {
        static::creating(function (Invoice $invoice) {
            //
        });

        static::deleting(function (Invoice $invoice) {
            if (config('eloquent-invoices.cascade_invoice_delete_to_invoice_items')) {
                $invoice->items()->delete();
            }
        });
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
