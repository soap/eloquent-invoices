<?php

// config for Soap/Eloquent/Invoice
use Soap\Eloquent\Invoice;
use Soap\Eloquent\InvoiceItem;


return [
    'model_invoice' => Invoice::class,
    'model_invoice_item' => InvoiceItem::class,

    'discount_class' => InvoiceDiscount::class,

    'cascade_invoice_delete_to_invoice_items' => true,
];
