<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;

class ContactController extends Controller
{
    public function sendContactEmail(Request $request)
    {
        Log::info('Request received', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Log::info('Request validated');

        $contact = Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        Log::info('Contact created', $contact->toArray());

        try {
            Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($contact) {
                $message->from($contact->email, $contact->name);
                $message->to('administrador@peluq.com', 'Administrador')
                        ->subject('Nuevo mensaje de contacto');
            });

            Log::info('Email sent', ['to' => 'administrador@peluq.com', 'from' => $contact->email]);
        } catch (\Exception $e) {
            Log::error('Error sending email', ['error' => $e->getMessage()]);
        }

        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}