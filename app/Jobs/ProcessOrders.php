<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Orders\OrderMailer;
use Illuminate\Support\Facades\Log;

use \Exception;

class ProcessOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orders;

    /**
     * Create a Job instance.
     *
     * @param Array $orders
     * @param ROVVP\OrderProcessor\Classes\OrderProcessor 
     * @return void
     */
    public function __construct(Array $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Job Handler
     *
     * @return void
     */
    public function handle()
    {
        try {
          OrderMailer::process($this->orders);
        } catch(Exception $e) {
           $this->failed($e);
        }
    }

    /**
     * Job Error Handler
     *
     * @return void
     */
    public function failed($exception) {
        Log::error("orderProcessing job has failed.");
    }
    
}