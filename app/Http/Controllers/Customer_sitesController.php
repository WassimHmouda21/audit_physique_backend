<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer_site;
use App\Models\Customer;
use App\Models\Project;
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


        public function getSitebyCustomerId($customerId)
    {
        // Find the customer by ID
        $customer = Customer::find($customerId);

        if (!$customer) {
            // Handle the case where the customer is not found
            return response()->json(['status' => 404, 'message' => 'Customer not found'], 404);
        }

        // Retrieve customer_sites associated with the customer
        $customerSites = $customer->customer_sites;

        if ($customerSites->count() > 0) {
            return response()->json(['status' => 200, 'customer_sites' => $customerSites], 200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No customer sites found for the given Customer_Id'], 404);
        }
    }

    public function getSitebyProjectId($projectId)
    {
        // Find the project by ID
        $project = Project::find($projectId);

        if (!$project) {
            // Handle the case where the project is not found
            return response()->json(['status' => 404, 'message' => 'Project not found'], 404);
        }

        // Retrieve project associated with the project
        $customerSites = $project->customer_sites;

        if ($customerSites->count() > 0) {
            return response()->json(['status' => 200, 'customer_sites' => $customerSites], 200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No project sites found for the given projectId'], 404);
        }
    }

    public function getCustomerSiteByID($id){
        $customer_sites = Customer_site::find($id);
        if(is_null($customer_sites)){
            return response()->json('Customer Site not found!', 404);
        }
        return response()->json($customer_sites, 200);
    }


}
