<?php

namespace Soap\Eloquent\Invoices\Models;

use Finller\Money\MoneyCast;
use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Soap\Eloquent\Invoices\Enums\InvoiceState;
use Soap\Eloquent\Invoices\Enums\InvoiceType;

class Invoice extends Model implements Attachable
{
    use HasFactory;

    protected $attributes = [
        'type' => InvoiceType::Invoice,
        'state' => InvoiceState::Draft,
    ];

    protected $guarded = [];

    protected $casts = [
        'type' => InvoiceType::class,
        'state_set_at' => 'datetime',
        'due_at' => 'datetime',
        'state' => InvoiceState::class,
        'seller_information' => AsArrayObject::class,
        'buyer_information' => AsArrayObject::class,
        'metadata' => AsArrayObject::class,
        'discounts' => Discounts::class,
        'subtotal_amount' => MoneyCast::class.':currency',
        'discount_amount' => MoneyCast::class.':currency',
        'tax_amount' => MoneyCast::class.':currency',
        'total_amount' => MoneyCast::class.':currency',
    ];

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

    public function items(): HasMany
    {
        return $this->hasMany(config('eloquent-invoices.model.invoice_item'));
    }

    /**
     * Any model that is the "parent" of the invoice like a Product ...
     **/
    public function invoiceable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Typically, the buyer is one of your users, teams or any other model.
     * When editing your invoice, you should not rely on the information of this relation as they can change in time and impact all buyer's invoices.
     * Instead you should store the buyer information in his property on the invoice creation/validation.
     */
    public function buyer(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * In case, your application is a marketplace, you would also attach the invoice to the seller
     * When editing your invoice, you should not rely on the information of this relation as they can change in time and impact all seller's invoices.
     * Instead you should store the seller information in his property on the invoice creation/validation.
     */
    public function seller(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Invoice can be attached with another one
     * A Quote or a Credit can have another Invoice as parent.
     * Ex: $invoice = $quote->parent and $quote = $invoice->quote
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function quote(): HasOne
    {
        return $this->hasOne(Invoice::class, 'parent_id')->where('type', InvoiceType::Quote->value);
    }

    public function credit(): HasOne
    {
        return $this->hasOne(Invoice::class, 'parent_id')->where('type', InvoiceType::Credit->value);
    }

    public function getTaxLabel(): ?string
    {
        return null;
    }

    /**
     * @return null|InvoiceDiscount[]
     */
    public function getDiscounts(): ?array
    {
        return $this->discounts;
    }

    public function scopeInvoice(Builder $query): Builder
    {
        return $query->where('type', InvoiceType::INVOICE);
    }

    public function scopeCreditNote(Builder $query): Builder
    {
        return $query->where('type', InvoiceType::CREDIT_NOTE);
    }

    public function scopeQuote(Builder $query): Builder
    {
        return $query->where('type', InvoiceType::QUOTE);
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->where('state', InvoiceState::PAID);
    }

    public function scopeRefunded(Builder $query): Builder
    {
        return $query->where('state', InvoiceState::REFUNDED);
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('state', InvoiceState::DRAFT);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('state', InvoiceState::PENDING);
    }

    /**
     * Get the attachable representation of the model.
     */
    public function toMailAttachment(): Attachment
    {
        /*
            return Attachment::fromData(fn () => $this->toPdfInvoice()->pdf()->output())
            ->as($this->toPdfInvoice()->getFilename())
            ->withMime('application/pdf');
        */
    }
}
