<?php

namespace App\Http\Controllers;
use App\Mail\ReclamationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; 
class UserController extends Controller
{
    //
    public function sendReclamationEmail(Request $request)
{
    $subject = $request->input('subject');
    $description = $request->input('description');

    try {
        // Send email from Outlook address to Gmail address
        Mail::to('wessimhmouda7@gmail.com')->send(new ReclamationEmail($subject, $description));

        // Check if any failures occurred during the sending process
        if (count(Mail::failures()) > 0) {
            // Log the failures
            \Log::error('Failed to send email: '.implode('; ', Mail::failures()));

            // Return JSON response for failure
            return new JsonResponse(['message' => 'Failed to send email. Please try again later.'], 500);
        }

        // Return JSON response for success
        return new JsonResponse(['message' => 'Reclamation email sent successfully!'], 200);
    } catch (\Exception $e) {
        // Log the exception
        \Log::error('Error sending email: '.$e->getMessage());

        // Return JSON response for other exceptions
        return new JsonResponse(['message' => 'An error occurred while sending email. Please try again later.'], 500);
    }
}


public function index()
{
    return response()->json(['message' => 'Please login'], 200);
}

// public function customLogin(Request $request)
// {
//     // Validate incoming request data
//     $request->validate([
//         'email' => 'required|string|email',
//         'password' => 'required|string',
//     ]);

//     $credentials = $request->only('email', 'password');
    
//     if (Auth::attempt($credentials)) {
//         // Authentication passed...
//         return response()->json(['message' => 'Signed in'], 200);
//     }

//     return response()->json(['error' => 'Email address or password is incorrect.'], 401);
// }

public function customLogin(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        // Authentication passed...
        $user = Auth::user(); // Get the authenticated user
        return response()->json(['message' => 'Signed in', 'user_id' => $user->id], 200);
    }

    return response()->json(['error' => 'Email address or password is incorrect.'], 401);
}

public function registration()
{
    return response()->json(['message' => 'Registration endpoint'], 200);
}

// public function stttoree(Request $request)
// {
//     // Validate incoming request data if needed

//     $user = new User();

//     $user->name = $request->input('name');
//     $user->email = $request->input('email');

//     $user->password = $request->input('password');
//     $user->birth = $request->input('birth');
//     $user->address = $request->input('address');
//     $user->role = $request->input('role');
//     $user->isEmailVerified = $request->input('isEmailVerified');


//     $user->save();

//     // Return the newly created user as a response
//     return response()->json(['message' => 'user created successfully', 'user' => $user], 201);
// }

public function stttoree(Request $request)
{    
    try {
        // Validate the incoming request data
        // $request->validate([
        //     'name' =>  'required|string',
        //     'email' => 'required|string',
        //     'password' => 'required|string',
        //     'birth' => 'required|date',
        //     'address' =>  'required|string',
        //     'role' => 'required|string',
        //     'isEmailVerified' => 'required|boolean',
        // ]);
        $request->validate([
            'name' =>  'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'birth' => 'required|date',
            'address' =>  'required|string',
            'role' => 'required|string',
            // 'isEmailVerified' => 'required|boolean',
        ]);
        

        // Log request data
        Log::info('Request Data:', $request->all());

        // Create a new user instance
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); 
        $user->birth = $request->input('birth');
        $user->address = $request->input('address');
        $user->role = $request->input('role');
        // $user->isEmailVerified = $request->input('isEmailVerified');
    
        // Save the user
        $user->save();

        // Log saved response
        Log::info('Saved Response:', $user->toArray());

        // Return the created user along with a success message
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    } catch (ValidationException $e) {
        // Log the validation error
        Log::error('Validation Error:', ['exception' => $e->getMessage()]);
        
        // Return validation error response
        return response()->json(['message' => $e->getMessage()], 422);
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error creating user:', ['exception' => $e]);

        // Return failure response
        return response()->json(['message' => 'Failed to create user'], 500);
    }
}



public function dashboard()
{
    if (Auth::check()) {
        return response()->json(['message' => 'Dashboard endpoint'], 200);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}

public function signOut() {
    Auth::logout();

    return response()->json(['message' => 'Logged out successfully'], 200);
}

}
