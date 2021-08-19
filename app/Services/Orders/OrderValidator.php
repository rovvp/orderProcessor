<?php

namespace App\Services\Orders;

use App\Services\Orders\Order;
use \DateTime;

/**
 * class OrderValidator
 * Providing Validator functions
 *
 */
class OrderValidator
{
    public static $errors = [];

    /**
     * function validateDate(String $date, $format)
     * Only allow Y-m-d h:iA format by default
     * Called for each transaction code given.
     * @return void
     */
    public static function validateDate(String $date, String $format = 'Y-m-d h:iA') : Void
    {
        $d = DateTime::createFromFormat($format, $date);
        if($d && $d->format($format) != $date) {
            array_push(SELF::$errors,"Invalid date ". $date);
        }
    }

    /**
     * function validateReference(String $date, $format)
     * called to check string values.
     * @return void
     */
    public static function validateReference(String $item) : Void
    {
        //check type is string
        if(!is_string($item)) {
            array_push(SELF::$errors,"Invalid reference");
        }
    }


    /**
     * function validateEmail(String $date, $format)
     * Only allow valid emails
     * @return void
     */
    public static function validateEmail(String $email) : Void
    {
        preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email, $matches);

        if(!count($matches)) {
            array_push(SELF::$errors,"Invalid Email ".$email);
        }
    }


    /**
     * function verifyOrderNumber(String $orderNumnber)
     * Called for each order number given. Format [country](1 digit)-[region](1 digit)-[orderNumber](10 char)
     * @return Void
     */
    public static function validateOrderNumber(String $order) : Void
    {
        preg_match("/^[0-9]{1}-[0-9]{1}-[a-z0-9]{10}$/i", $order, $matches);

        if(!count($matches)) {
            array_push(SELF::$errors,"Invalid Order Number ".$order);
        }

    }

    /**
     * function validateCustomerNumber(String $customerNumber)
     * Called for each order number given. 10 char
     * @return Void
     */
    public static function validateCustomerNumber(String $customer) : Void
    {
        preg_match("/^[a-z0-9]{10}$/i", $customer, $matches);

        if(!count($matches)) {
            array_push(SELF::$errors,"Invalid Customer Number ".$customer);
        }
    }

    /**
     * function validateAmount(String $orderNumnber)
     * Called for each order number given. Must be 10char alpha numeric
     * @return Void
     */
    public static function validateAmount($amount) : Void
    {
        if(!is_numeric($amount)) {
            array_push(SELF::$errors,"Invalid Amount ".$amount);
        }
    }

}
