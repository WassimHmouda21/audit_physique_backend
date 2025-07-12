<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Predefined_observations;

class Predefined_observationsController extends Controller
{
    public function getobservationsbyQuestion($question_id)
    {
        // Find the question by ID
        $question = Question::find($question_id);

        if (!$question) {
            return response()->json(['status' => 404, 'message' => 'Question not found'], 404);
        }

        // Retrieve predefined_observations associated with the question
        $predefined_observations = $question->predefined_observations;

        if ($predefined_observations->count() > 0) {
            return response()->json(['status' => 200, 'predefined_observations' => $predefined_observations], 200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No predefined observations found for the given question'], 404);
        }
    }
}
