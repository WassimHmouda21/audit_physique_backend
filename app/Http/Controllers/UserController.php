<?php

namespace App\Http\Controllers;
use App\Mail\ReclamationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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
    try {
        $validateUser = Validator::make($request->all(), 
        [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'user_id' => $user->id
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}



// public function stttoree(Request $request)
// {    
//     try {
//         // Validate the incoming request data
//         $request->validate([
//             'name' => 'required|string',
//             'email' => 'required|string|email|unique:users',
//             'password' => 'required|string|min:8',
//             'birth' => 'required|date_format:Y-m-d',
//             'address' => 'required|string',
//             'role' => 'required|string',
//         ]);

//         // Log request data
//         Log::info('Request Data:', $request->all());

//         // Create a new user instance
//         $user = new User();
//         $user->name = $request->input('name');
//         $user->email = $request->input('email');
//         $user->password = Hash::make($request->input('password')); 
//         $user->birth = $request->input('birth');
//         $user->address = $request->input('address');
//         $user->role = $request->input('role');
//         $user->save();

//         // Log saved response
//         Log::info('Saved Response:', $user->toArray());

//         // Generate a token
//         $token = $user->createToken('auth_token')->plainTextToken;

//         // Return the created user along with a success message and token
//         return response()->json([
//             'message' => 'User created successfully',
//             'user' => $user,
//             'token' => $token
//         ], 201);
//     } catch (ValidationException $e) {
//         // Log the validation error
//         Log::error('Validation Error:', ['errors' => $e->errors()]);
//         return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
//     } catch (\Exception $e) {
//         // Log the error
//         Log::error('Error creating user:', ['exception' => $e]);
//         return response()->json(['message' => 'Failed to create user'], 500);
//     }
// }
public function stttoree(Request $request)
{    
    try {
        // Validate the incoming request data
        $validateUser = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
      
        ]);
        
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        // Create a new user instance
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
      
        ]); 

        // Save the user and generate a token
        $token = $user->createToken('API Token')->plainTextToken;

        // Return response with token
        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'token' => $token
        ], 200);
    
    } catch (\Throwable $th)  {
        return response()->json([
            'status' => false,
            'message' => 'Error creating user: ' . $th->getMessage()
        ], 500);
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
