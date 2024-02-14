<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Categorie;
class QuestionController extends Controller
{
    //
    public function index()
    {
          $questions = Question::all();
          if($questions->count() > 0){
          return response()->json([
               'status' => 200,
               'questions' => $questions
          
        ], 200);
          }else{
            return response()->json([
                'status' => 200,
                'questions' => 'No Records Found'
           
         ], 404);

          }
        }

        public function getQuestionbyCategorie($categorie_id)
        {
            // Find the customer by ID
            $categorie = categorie::find($categorie_id);
    
            if (!$categorie) {
                // Handle the case where the customer is not found
                return response()->json(['status' => 404, 'message' => 'Categorie not found'], 404);
            }
    
            // Retrieve customer_sites associated with the customer
            $Questions = $categorie->questions;
    
            if ($Questions->count() > 0) {
                return response()->json(['status' => 200, 'questions' => $Questions], 200);
            } else {
                return response()->json(['status' => 404, 'message' => 'No customer sites found for the given categorieId'], 404);
            }
        }
    
}
