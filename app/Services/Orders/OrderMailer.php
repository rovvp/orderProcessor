<?php

namespace App\Services\Orders;

use App\Mail\Invoice;
use Illuminate\Support\Facades\Mail;

/**
 * class OrderMailer
 * Provides the business logic and processing for our banking app.
 *
 */
class OrderMailer
{
    /**
     * function process(array $input)
     * dispatch a mail message for each order (already validated)
     * @return Void
     */
    public static function process(Array $orderResult) : Void
    {
        foreach ($orderResult as $item) {

            //for valid orders
            if(!count($item['errors'])) {
                Mail::to($item['order']->customerEmail)->queue(new Invoice($item['order']));
            }

        }

    }

}
