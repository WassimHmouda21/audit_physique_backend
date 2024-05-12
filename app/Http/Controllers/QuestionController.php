<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Categorie;
use Illuminate\Support\Facades\Log;

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


        public function insertQuestionsToCategorie($sourceCategorieId, $targetCategorieId)
        {
            try {
                // Find the source categorie by ID
                $sourceCategorie = Categorie::find($sourceCategorieId);
        
                if (!$sourceCategorie) {
                    // Handle the case where the source categorie is not found
                    return response()->json(['status' => 404, 'message' => 'Source Categorie not found'], 404);
                }
        
                // Retrieve categories associated with the categorie site
                $questions = $sourceCategorie->questions;
        
                // Find the target categorie by ID
                $targetCategorie = Categorie::find($targetCategorieId);
        
                if (!$targetCategorie) {
                    // Handle the case where the target categorie is not found
                    return response()->json(['status' => 404, 'message' => 'Target Categorie not found'], 404);
                }
        
                if ($questions->count() > 0) {
                    // Create new entries in the database for each category associated with the target categorie
                    foreach ($questions as $category) {
                        $newQuestion = new Question([
                            'ordre' => $category->ordre,
                            'Ref' => $category->Ref,
                            'Question' => $category->Question,
                            'categorie_id' => $targetCategorie->id,
                        ]);
                        $newQuestion->save();
                    }
        
                    // Return success response
                    return response()->json(['status' => 200, 'message' => 'Questions inserted successfully'], 200);
                } else {
                    return response()->json(['status' => 404, 'message' => 'No Questions found for the given Source categorie_id'], 404);
                }
            } catch (\Exception $e) {
                // Log the error
                Log::error('Error inserting Questions:', ['exception' => $e]);
        
                // Return failure response
                return response()->json(['status' => 500, 'message' => 'Failed to insert Questions'], 500);
            }
        }
    
}
