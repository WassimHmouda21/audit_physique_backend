<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Reponse; 
use App\Models\Question; 
use Illuminate\Http\Response;

class ReponseController extends Controller
{
    public function putReponsebyId(Request $request, $id)
    {
        try {
            // Validate the request data
            $this->validate($request, [
                'conformite' => 'required|integer',
                'commentaire' => 'required|string',
            ]);

            // Find the Reponse by ID
            $reponse = Reponse::find($id);

            // Check if the Reponse exists
            if (!$reponse) {
                // Log the error
                Log::error("Reponse not found for ID: $id");
                return response()->json(['message' => 'Reponse not found'], 404);
            }

            // Update the Reponse with the new data
            $reponse->conformite = $request->input('conformite');
            $reponse->commentaire = $request->input('commentaire');

            // Save the changes
            $reponse->save();

            // Log the success
            Log::info("Reponse updated successfully for ID: $id");

            // Return a response
            return response()->json(['message' => 'Reponse updated successfully', 'data' => $reponse], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error("Error updating Reponse for ID: $id - " . $e->getMessage());
            Log::error($e->getTraceAsString()); // Log the stack trace

            // Return an error response
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }


    public function putResponseByQuestionId(Request $request, $question_id)
{
   try {
        // Validate the request data
        $this->validate($request, [
            'conformite' => 'required|integer',
            'commentaire' => 'required|string',
        ]);

        // Find the Reponse by ID
        $reponse = Reponse::find($question_id);

        // Check if the Reponse exists
        if (!$reponse) {
            // Log the error
            Log::error("Reponse not found for question_id: $question_id");
            return response()->json(['message' => 'Reponse not found'], 404);
        }

        // Update the Reponse with the new data
        $reponse->conformite = $request->input('conformite');
        $reponse->commentaire = $request->input('commentaire');

        // Save the changes
        $reponse->save();

        // Log the success
        Log::info("Reponse updated successfully for question_id: $question_id");

        // Return a response
        return response()->json(['message' => 'Reponse updated successfully', 'data' => $reponse], 200);
    } catch (\Exception $e) {
        // Log any exceptions
        Log::error("Error updating Reponse for question_id: $question_id - " . $e->getMessage());
        Log::error($e->getTraceAsString()); // Log the stack trace

        // Return an error response
        return response()->json(['message' => 'Internal server error'], 500);
    }
}


public function getResponseByQuestionId($question_id)
    {
        // Find the customer by ID
        $question = Question::find($question_id);

        if (!$question) {
            // Handle the case where the customer is not found
            return response()->json(['status' => 404, 'message' => 'Question not found'], 404);
        }

        // Retrieve customer_sites associated with the customer
        $reponses = $question->reponses;

        if ($reponses->count() > 0) {
            return response()->json(['status' => 200, 'reponses' => $reponses], 200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No reponses found for the given question_id'], 404);
        }
    }


// public function getResponseByQuestionId($question_id){
//     $reponses = Reponse::find($question_id);
//     if(is_null($reponses)){
//         return response()->json('Reponse not found!', 404);
//     }
//     return response()->json($reponses, 200);
// }


    
    // public function putReponsebyQuestion($question_id)
    // {
    //     // Find the customer by ID
    //     $question = question::find($question_id);

    //     if (!$question) {
    //         // Handle the case where the customer is not found
    //         return response()->json(['status' => 404, 'message' => 'question not found'], 404);
    //     }

    //     // Retrieve customer_sites associated with the customer
    //     $Reponse = $question->reponses;

    //     if ($Reponses->count() > 0) {
    //         return response()->json(['status' => 200, 'reponses' => $Reponses], 200);
    //     } else {
    //         return response()->json(['status' => 404, 'message' => 'No reponses found for the given question'], 404);
    //     }
    // }
    public function createResponseByQuestionId(Request $request, $question_id)
{
    try {
        // Validate the incoming request data
        $request->validate([
            'projet_id' => 'required|exists:projects,id',
            'conformite' => 'required|integer',
            'commentaire' => 'required|string',
            'site' => 'required|exists:customer_sites,id',
            // Add more validation rules as needed
        ]);

        // Log request data
        Log::info('Request Data:', $request->all());

        // Find the question by ID
        $question = Question::findOrFail($question_id);

        // Log found question
        Log::info('Found Question:', $question->toArray());

        // Create a new response for the question
        $reponse = new Reponse();
        $reponse->projet_id = $request->input('projet_id');
        $reponse->question_id = $question_id;
        $reponse->conformite = $request->input('conformite');
        $reponse->commentaire = $request->input('commentaire');
        $reponse->site = $request->input('site');
        $reponse->save();

        // Log saved response
        Log::info('Saved Response:', $reponse->toArray());

        // Return the created response along with a success message
        return response()->json([
            'message' => 'Response created successfully',
            'response' => $reponse // Include the newly created response data
        ], 201);
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error creating response:', ['exception' => $e]);

        // Optionally, you can return a response indicating failure
        return response()->json(['message' => 'Failed to create response'], 500);
    }
}

public function deleteReponseById(Request $request, $id)
    {
        $reponse = Reponse::find($id);
        
        if (!$reponse) {
            return response()->json(['message' => 'Reponse not found'], 404);
        }

        $reponse->delete();

        return response()->json(['message' => 'Reponse deleted successfully'], 200);
    }


    }