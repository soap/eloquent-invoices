<?php

namespace Soap\Eloquent\Invoices\Enums;

enum InvoiceState: string
{
    case DRAFT = 'draft';
    case SENT = 'sent';
    case PENDING = 'pending';
    case PAID = 'paid';
    case PARTIALLY_PAID = 'partially_paid';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';

    public function trans()
    {
        return match ($this) {
            self::DRAFT => __('Draft'),
            self::SENT => __('Sent'),
            self::PENDING => __('Pending'),
            self::PAID => __('Paid'),
            self::PARTIALLY_PAID => __('Partially Paid'),
            self::CANCELLED => __('Cancelled'),
            self::REFUNDED => __('Refunded'),
        };
    }
}
