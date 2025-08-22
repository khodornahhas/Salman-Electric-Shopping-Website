<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        $data = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? 'N/A',
            'body'  => $validated['message'], 
        ];

        Mail::send('emails.contact', $data, function ($mail) use ($validated) {
            $mail->to(config('mail.owner_email'))
                 ->subject('New Contact Form Submission')
                 ->replyTo($validated['email'], $validated['name']);
        });

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
