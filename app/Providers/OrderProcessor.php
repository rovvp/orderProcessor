<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;

class OrderProcessor extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind('Company\Orders\OrderProcessorInterface', 'Company\Orders\OrderProcessor');
        $this->app->bind('OrderProcessor', function () {
            return new App\Orders\OrderProcessor;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::after(function (JobProcessed $event) {
            Log::info("orderProcessing job has now completed.");
        });
    }
}
