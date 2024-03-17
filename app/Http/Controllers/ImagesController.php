<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image; 
use App\Models\Reponse;

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
        if ($request->hasFile('image')) {
            // Save the image to the assets directory
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $path = public_path('assets/');
          
            $request->image->move($path, $imageName);
        
            // Create a new Image instance
            $image = new Image;
            $image->Path = 'assets/' . $imageName; // Adjust path if necessary
            // $image->reponse_id = 1; // Set the response_id to 1 by default
            $image->reponse_id = $request->reponse_id;
            $image->save();
        
            return response()->json(['message' => 'Image uploaded successfully'], 200);
        }
        
        return response()->json(['error' => 'No image uploaded'], 400);
    }
    

    

//     public function addimage(Request $request)
// {
//     $image = new Image;

//     if ($request->hasFile('image')) {
//         $path = $request->file('image')->store('images');
//         $image->Path = $path;
//         // Set the reponse_id to 1 by default
//         $image->reponse_id = 1;
//         $image->save();
//         return response()->json(['message' => 'Image uploaded successfully'], 200);
//     }

//     return response()->json(['error' => 'No image uploaded'], 400);
// }

public function displayimage()
{
    // $customers = Customer::all();
    // return view('customerform')->with('customers', $customers);
    $images = Image::all();
    //return view('customer.index', compact('customers'));
    return response()->json([
        'images' => $images ],200);
}
public function getImagebyReponseId($reponse_id)
{
    // Find the response by ID
    $reponse = Reponse::find($reponse_id);

    if (!$reponse) {
        // Handle the case where the response is not found
        return response()->json(['status' => 404, 'message' => 'Response not found'], 404);
    }

    // Retrieve images associated with the response
    $images = $reponse->images;

    if ($images->count() > 0) {
        // Return response with images and response ID
        return response()->json(['status' => 200, 'reponse_id' => $reponse->id, 'images' => $images], 200);
    } else {
        return response()->json(['status' => 404, 'message' => 'No images found for the given response ID'], 404);
    }
}





}
