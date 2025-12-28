<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:5'],
        ]);


        $contact = ContactMessage::create($validated);


        $adminEmail = config('mail.admin_email', env('ADMIN_EMAIL', 'admin@ehb.be'));

        Mail::raw(
            "Nieuw contactbericht van {$contact->name} <{$contact->email}>\n\n"
            ."Onderwerp: ".($contact->subject ?? '(geen onderwerp)')."\n\n"
            ."Bericht:\n{$contact->message}",
            function ($message) use ($adminEmail, $contact) {
                $message->to($adminEmail)
                ->replyTo($contact->email, $contact->name)
                ->subject('Nieuw contactbericht van de fotomuseum-site');
            }
        );

        return redirect()
            ->route('contact.create')
            ->with('status', 'Bedankt voor je bericht! Ik neem zo snel mogelijk contact op.');
    }
}
