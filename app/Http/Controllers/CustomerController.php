<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
class CustomerController extends Controller
{
    public function index()
    {
          $customers = Customer::all();
          if($customers->count() > 0){
          return response()->json([
               'status' => 200,
               'customers' => $customers
          
        ], 200);
          }else{
            return response()->json([
                'status' => 200,
                'customers' => 'No Records Found'
           
         ], 404);

          }
        }
}
