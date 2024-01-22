<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
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
}
