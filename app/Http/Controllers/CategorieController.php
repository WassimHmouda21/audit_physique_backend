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
}
