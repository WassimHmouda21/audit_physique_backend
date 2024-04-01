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

        public function getProjectByID($id){
            $project = Project::find($id);
            if(is_null($project)){
                return response()->json(['error' => 'Project not found!'], 404);
            }
            return response()->json(['project' => $project], 200);
        }
     
        public function updateProject(Request $request, $projectId)
    {
        try {
            // Find the project by ID
            $project = Project::findOrFail($projectId);
            
            // Update the is_submitted attribute to true
            $project->is_submitted = true;
            
            // Save the changes
            $project->save();
            
            // Return success response
            return response()->json(['message' => 'Project updated successfully'], 200);
        } catch (\Exception $e) {
            // Return error response if any error occurs
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getSubmittedProjects()
    {
        $projects = Project::where('is_submitted', true)->get();

        return response()->json(['projects' => $projects], 200);
    }
}
