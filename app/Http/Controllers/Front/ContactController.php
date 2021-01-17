<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

use App\Models\Page;
use Illuminate\Support\Facades\Mail;

use App\Mail\MailSend;

use App\Models\Property;
use App\Models\Recipient;
use App\Models\RodoRules;

use App\Notifications\ContactNotification;
use App\Notifications\PropertyNotification;

use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class ContactController extends Controller
{
    function index(){

        $page = Page::where('id', 9)->first();

        return view('front.contact.index', [
            'rules' => RodoRules::orderBy('sort')->whereStatus(1)->get(),
            'page' => $page
        ]);
    }

    function property(ContactFormRequest $request, $id){

        Property::find($id)->notify(new PropertyNotification($request));
        Mail::to(config('mail.from.address'))->send(new MailSend($request));

        return redirect()->back()->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szczegółów!');
    }

    function send(ContactFormRequest $request, Recipient $recipient){
        $recipient->notify(new ContactNotification($request));

        Mail::to(config('mail.from.address'))->send(new MailSend($request));

        (new \App\Models\RodoClient)->saveOrCreate($request);

        Tracker::trackEvent(['event' => 'contact.form:contact', 'object' => json_encode($request->only(['form_name', 'form_email', 'form_message'], true))]);

        return redirect()->back()->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szczegółów!');
    }
}
