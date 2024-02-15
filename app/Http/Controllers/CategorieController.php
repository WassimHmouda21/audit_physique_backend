<?php

namespace App\Http\Controllers;
use App\Models\Categorie;

use Illuminate\Http\Request;

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

      public function getCategorieByID($id){
        $categories = Categorie::find($id);
        if(is_null($categories)){
            return response()->json('Categorie not found!', 404);
        }
        return response()->json($categories, 200);
    }
}
