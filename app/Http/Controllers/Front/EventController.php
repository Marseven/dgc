<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Attendee;
use App\Models\Compagnie;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Ticket;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::where('status', 'active')->where('end_time', '>', NOW())->paginate(4);
        return view('front.event.index', compact('events'));
    }

    public function item(Event $event)
    {
        $tickets = Ticket::where('event_id', $event->id)->get();
        return view('front.event.item', compact('event', 'tickets'));
    }

    public function storeAttendee(Request $request)
    {

        $rules = [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'ticket_id' => ['required'],
            'event_id' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], 200);
        }

        $attendee = new Attendee();

        $attendee->last_name = $request->last_name;
        $attendee->first_name = $request->first_name;
        $attendee->phone = $request->phone;
        $attendee->email = $request->email;

        if ($attendee->save()) {
            $registration = new Registration();

            $registration->attendee_id = $attendee->id;
            $registration->event_id = $request->event_id;
            $registration->ticket_id = $request->ticket_id;

            if ($registration->save()) {
                return back()->with('success', 'Votre inscription a bien été enregistré. <a href="' . url('print/' . $registration->id) . '" target="_blank">Télécharger votre ticket ici</a>. Vous pouvez également le trouver dans boîte mail.');
            }
        }
    }

    public function storeCompagnie(Request $request)
    {
        $rules = [
            'name' => ['required'],
            'manager' => ['required'],
            'adress' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'postal_code' => ['required'],
            'activity' => ['required'],
            'business_circuit' => ['required'],
            'legal_status' => ['required'],
            'event_id' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $compagnie = new Compagnie();

        $compagnie->name = $request->name;
        $compagnie->manager = $request->manager;
        $compagnie->phone = $request->phone;
        $compagnie->email = $request->email;
        $compagnie->address = $request->adress;
        $compagnie->city = $request->city;
        $compagnie->state = $request->state;
        $compagnie->country = $request->country;
        $compagnie->postal_code = $request->postal_code;
        $compagnie->business_circuit = $request->business_circuit;
        $compagnie->legal_status = $request->legal_status;
        $compagnie->activity = $request->activity;
        $compagnie->website = $request->website;
        $compagnie->status = "pending";
        $compagnie->event_id = $request->event_id;

        if ($request->file('business_url')) {
            $picture = FileController::importation($request->file('business_url'), 'fiche');
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $compagnie->business_url =  $url;
        }

        if ($compagnie->save()) {
            return back()->with('success', "Votre demande a été soumise avec succès. Nous vous contacterons au plus tôt.");
        }
    }

    public function print(Registration $registration)
    {
        // Configure Dompdf
        $registration->load(['event', 'ticket', 'attendee']);

        $data = compact(
            'registration',
        );

        $largeur_etiquette = 5; // en cm
        $hauteur_etiquette = 3; // en cm

        $pdf = PDF::loadView('pdf.ticket', $data)->setPaper(array(0, 0, 300, 500), 'landscape');

        // Télécharger le PDF
        return $pdf->download('Ticket_' . $registration->id . '.pdf');
    }
}
