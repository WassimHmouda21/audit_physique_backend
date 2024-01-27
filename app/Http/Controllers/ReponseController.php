<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Reponse; 

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
}
