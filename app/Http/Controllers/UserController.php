<?php

namespace App\Http\Controllers;
use App\Mail\ReclamationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
}
