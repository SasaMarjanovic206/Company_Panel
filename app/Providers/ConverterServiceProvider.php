<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CurrencyConverterInterface;
use App\Services\FixerCurrencyConverter;

class ConverterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyConverterInterface::class, FixerCurrencyConverter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
