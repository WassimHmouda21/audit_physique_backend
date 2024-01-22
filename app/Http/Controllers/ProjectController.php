<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
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
}
