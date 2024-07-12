<?php

namespace Soap\Eloquent\Invoices;

use Soap\Eloquent\Invoices\Commands\InvoiceCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InvoiceServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eloquent-invoices')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations([
                'create_invoices_table',
                'create_invoice_items_table'
            ])
            ->hasCommand(InvoiceCommand::class);
    }
}
