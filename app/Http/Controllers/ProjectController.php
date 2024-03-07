<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Customer;
class ProjectController extends Controller
{
    //
    public function index()
    {
          $projects = Project::all();
          if($projects->count() > 0){
          return response()->json([
               'status' => 200,
               'questions' => $projects
          
        ], 200);
          }else{
            return response()->json([
                'status' => 200,
                'projects' => 'No Records Found'
           
         ], 404);

          }
        }


        public function getProjectbyCustomerId($customerId)
        {
            // Find the customer by ID
            $customer = Customer::find($customerId);
    
            if (!$customer) {
                // Handle the case where the customer is not found
                return response()->json(['status' => 404, 'message' => 'Customer not found'], 404);
            }
    
            // Retrieve customer_sites associated with the customer
            $projects = $customer->projects;
    
            if ($projects->count() > 0) {
                return response()->json(['status' => 200, 'projects' => $projects], 200);
            } else {
                return response()->json(['status' => 404, 'message' => 'No projects found for the given Customer_Id'], 404);
            }
        }
}
