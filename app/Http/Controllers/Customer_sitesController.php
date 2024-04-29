<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer_site;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

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
    public function storeSite(Request $request, $Customer_Id , $Project_id)
    { 
        try {
            $validatedData = $request->validate([
                'Numero_site' => 'required|integer',
                'Structure' => 'required|string',
                'Lieu' => 'required|string',
                'Customer_Id' => 'required|exists:customers,id', // Ensure customer exists
                'Project_id' => 'required|exists:projects,id'
             
            ]);
    
            // Log validated data
            Log::info('Validated Data:', $validatedData);
    
            // Create a new project instance
            $customer_site = Customer_site::create($validatedData);
    
            // Log saved response
            Log::info('Saved Customer_site:', $customer_site->toArray());
    
            // Return the created project along with a success message
            return response()->json([
                'message' => 'Customer_site created successfully',
                'customer_site' => $customer_site
            ], 201);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating Customer_site:', ['exception' => $e]);
    
            // Return failure response
            return response()->json(['message' => 'Failed to create Customer_site'], 500);
        }
    }
    

}
