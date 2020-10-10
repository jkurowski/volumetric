<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Notifications\ContactNotification;

use App\Property;

class ContactController extends Controller
{
    function property(ContactFormRequest $request, $id){

        Property::find($id)->notify(new ContactNotification($request));

        return redirect()->back()->with('success', 'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szczegółów!');
    }
}
