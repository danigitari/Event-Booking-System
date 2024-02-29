<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

class EventsController extends Controller
{
    public function getEvents()
    {
        return response()->json([
            'message' => 'Events fetched successfully',
            'events' => Event::all()->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Event created successfully',
            'event' => $event,
        ]);
    }

    public function buyTicket(Request $request)

    {
        $event = Event::find($request->event_id);
        if ($event->tickets()->count() >= $event->max_attendees) {
            return response()->json([
                'message' => 'Event is full',
            ], 200);
        }
        if (Ticket::where('user_id',auth()->user()->id)->where('event_id', $request->event_id)->count() > 5) {
            return response()->json([
                'message' => 'You have already purchased 5 tickets for this event',
            ], 200);
        } else {
            $event->tickets()->create([
                'ticketType' => $request->ticketType,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_id' => auth()->user()->id,
            ]);

            return response()->json([
                'message' => 'Ticket purchased successfully',
            ]);
        }
    }
}
