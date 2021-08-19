<?php

namespace App\Services\Orders;

/**
 * class Order
 * Holds a named data map of rows input via the CSV
 *
 */
class Order
{
    private $orderId;
    private $customerId;
    private $customerEmail;
    private $date;
    private $reference;
    private $amount;

    public function __set($name, $val)
    {
        $this->$name = $val;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
