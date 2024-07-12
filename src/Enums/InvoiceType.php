<?php

namespace Soap\Eloquent\Invoices\Enums;

enum InvoiceType: string {
    case INVOICE = 'invoice';
    case QUOTE = 'quote';
    case CREDIT_NOTE = 'credit_note';
    case PRO_FORMA = 'pro_forma';

    public function trans()
    {
        return match($this) {
            self::INVOICE => __('Invoice'),
            self::QUOTE => __('Quote'),
            self::CREDIT_NOTE => __('Credit Note'),
            self::PRO_FORMA => __('Pro Forma'),
        };
    }
}