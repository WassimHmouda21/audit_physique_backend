<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Customer_site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        if($categories->count() > 0){
        return response()->json([
             'status' => 200,
             'categories' => $categories
        
      ], 200);
        }else{
          return response()->json([
              'status' => 200,
              'categories' => 'No Records Found'
         
       ], 404);

        }
      }
      public function getCategorieBySiteId($CustomerSite_Id)
{
    // Find the response by ID
    $customer_site = Customer_site::find($CustomerSite_Id);

    if (!$customer_site) {
        // Handle the case where the response is not found
        return response()->json(['status' => 404, 'message' => 'customer_site not found'], 404);
    }

    // Retrieve images associated with the response
    $categories = $customer_site->categories;

    if ($categories->count() > 0) {
        // Return response with images and response ID
        return response()->json(['status' => 200, 'CustomerSite_Id' => $customer_site->id, 'categories' => $categories], 200);
    } else {
        return response()->json(['status' => 404, 'message' => 'No images found for the given CustomerSite_Id'], 404);
    }

}     
      
      public function getCategorieByID($id){
        $categories = Categorie::find($id);
        if(is_null($categories)){
            return response()->json('Categorie not found!', 404);
        }
        return response()->json($categories, 200);
    }



 

    public function insertCategoriesToCustomerSite($sourceCustomerSiteId, $targetCustomerSiteId)
    {
        try {
            // Find the source customer site by ID
            $sourceCustomerSite = Customer_site::find($sourceCustomerSiteId);
    
            if (!$sourceCustomerSite) {
                // Handle the case where the source customer site is not found
                return response()->json(['status' => 404, 'message' => 'Source Customer_site not found'], 404);
            }
    
            // Retrieve categories associated with the source customer site
            $categories = $sourceCustomerSite->categories;
    
            // Find the target customer site by ID
            $targetCustomerSite = Customer_site::find($targetCustomerSiteId);
    
            if (!$targetCustomerSite) {
                // Handle the case where the target customer site is not found
                return response()->json(['status' => 404, 'message' => 'Target Customer_site not found'], 404);
            }
    
            if ($categories->count() > 0) {
                // Create new entries in the database for each category associated with the target customer site
                foreach ($categories as $category) {
                    $newCategory = new Categorie([
                        'Nom' => $category->Nom,
                        'CustomerSite_Id' => $targetCustomerSite->id,
                    ]);
                    $newCategory->save();
                }
    
                // Return success response
                return response()->json(['status' => 200, 'message' => 'Categories inserted successfully'], 200);
            } else {
                return response()->json(['status' => 404, 'message' => 'No categories found for the given Source CustomerSite_Id'], 404);
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error inserting categories:', ['exception' => $e]);
    
            // Return failure response
            return response()->json(['status' => 500, 'message' => 'Failed to insert categories'], 500);
        }
    }

}
