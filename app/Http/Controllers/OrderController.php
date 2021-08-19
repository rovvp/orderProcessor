<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ProcessOrders;
use App\Services\Orders\OrderParser;

/**
 * OrderController
 * Handles routed routed actions for the banking app.
 */

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('orders')->with("orders", []);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upload(Request $request)
    {

        //simple form validation
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return view('orders')->with("errors", $validator->errors(), "orders", []);
        }

        //process the file using custom order processor class
        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        //first parse the rows to validate data.
        $orders = OrderParser::process($data);

        //dispatch processor as job
        ProcessOrders::dispatch($orders);

        return view('orders')->with("orders", $orders);

    }
}
