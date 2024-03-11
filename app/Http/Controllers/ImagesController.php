<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image; 
class ImagesController extends Controller
{
    // public function addimage(Request $request)
    // {
    //     $image = new Image;

    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('images');
    //         $image->Path = $path;
    //         // Assuming you have 'reponse_id' available in the request
    //         $image->reponse_id = $request->reponse_id;
    //         $image->save();
    //         return response()->json(['message' => 'Image uploaded successfully'], 200);
    //     }

    //     return response()->json(['error' => 'No image uploaded'], 400);
    // }

    public function addimage(Request $request)
{
    $image = new Image;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images');
        $image->Path = $path;
        // Set the reponse_id to 1 by default
        $image->reponse_id = 1;
        $image->save();
        return response()->json(['message' => 'Image uploaded successfully'], 200);
    }

    return response()->json(['error' => 'No image uploaded'], 400);
}

}
