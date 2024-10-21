<?php

namespace App\Controllers;

use App\Models\Customer;

class HomeController extends BaseController {

    public static function index () {
        $customers = Customer::all();
        

        self::loadView('/home', [
            'title' => 'Homepage',
            'customers' => $customers
        ]);
    }

    public static function edit ($id) {
        // print_r($id);
        $customer = Customer::find($id);
         print_r($customer);

         // load view
        
    }

}