<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve form data
        $data = $request->only('name', 'email', 'message');

        // You can send an email or store the inquiry in a database
        // For example, using Mail (ensure you have set up mail configuration in .env file)
        Mail::raw("Name: {$data['name']}\nEmail: {$data['email']}\nMessage:\n{$data['message']}", function($message) {
            $message->to('youremail@example.com') // Replace with your email address
                    ->subject('New Inquiry');
        });

        return redirect()->back()->with('success', 'Thank you for your inquiry. We will get back to you soon.');
    }
}
