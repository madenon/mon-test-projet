<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        $information = Information::first(); // only one row in the table

        return view('contact.index', compact('information'));
        
    }

    public function send(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Get the form data
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        // Additional data you may want to pass to the email view
        $data = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ];

        // Send the email
        Mail::to(env('MAIL_USERNAME'))->send(new ContactFormMail($data));

        return redirect('/contact')->with('success', 'Your message has been sent successfully!');
    }
}
