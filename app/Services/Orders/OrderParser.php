<?php

namespace App\Services\Orders;

use App\Services\Orders\Order;
use App\Services\Orders\OrderValidator;

/**
 * class OrderProcessor
 * Provides the business logic and processing for our banking app.
 *
 */
class OrderParser
{
    private static $orders = [];

    /**
     * function process(array $input)
     * a static function accepting an array of transactions and converting each
     * into a transaction object.
     * @return Void
     */
    public static function process(Array $orders) : Array
    {
        
        //remove the headers
        array_shift($orders);

        //process the orders (each row needs to be date,orderNumber,customerNumber,reference,amount). We validate the input is correct.
        foreach ($orders as $key=>$val) {

            $order  = new Order;

            //map the row (prevent undefined offset)
            $order->date = (isset($val[0])) ? $val[0] : null;
            $order->orderNumber = (isset($val[1])) ? $val[1] : null;
            $order->customerNumber = (isset($val[2])) ? $val[2] : null;
            $order->customerEmail = (isset($val[3])) ? $val[3] : null;
            $order->reference = (isset($val[4])) ? $val[4] : null;
            $order->amount = (isset($val[5])) ? $val[5] : null;

            //validate order
            OrderValidator::validateDate($order->date);
            OrderValidator::validateOrderNumber($order->orderNumber);        
            OrderValidator::validateCustomerNumber($order->customerNumber);    
            OrderValidator::validateReference($order->reference);    
            OrderValidator::validateEmail($order->customerEmail);    
            OrderValidator::validateAmount($order->amount);    
         
            //each order is stored with or without errors
            array_push(SELF::$orders, array("order"=>$order, "errors"=>OrderValidator::$errors));
        
            //clear errors for next row
            OrderValidator::$errors = [];

        }

        return SELF::$orders;

    }

}
