<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer_site;
class Customer_sitesController extends Controller
{
    public function index()
    {
          $customer_sites = Customer_site::all();
          if($customer_sites->count() > 0){
          return response()->json([
               'status' => 200,
               'customer_sites' => $customer_sites
          
        ], 200);
          }else{
            return response()->json([
                'status' => 200,
                'customer_sites' => 'No Records Found'
           
         ], 404);

          }
        }
}
