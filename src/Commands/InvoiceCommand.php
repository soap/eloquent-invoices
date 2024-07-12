<?php

namespace Soap\Eloquent\Invoices\Commands;

use Illuminate\Console\Command;

class InvoiceCommand extends Command
{
    public $signature = 'eloquent-invoices';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
