<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContactEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => htmlspecialchars($request->input('name')),
            'email' => htmlspecialchars($request->input('email')),
            'message' => htmlspecialchars($request->input('message')),
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from($data['email'], $data['name']);
            $message->to('administrador@peluq.com', 'Administrador')
                    ->subject('Nuevo mensaje de contacto');
        });

        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}