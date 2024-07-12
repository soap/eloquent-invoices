<?php

namespace Soap\Eloquent\Invoice;

use Soap\Eloquent\Invoice\Commands\InvoiceCommand;
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
            ->hasMigration('create_invoices_table')
            ->hasCommand(InvoiceCommand::class);
    }
}
