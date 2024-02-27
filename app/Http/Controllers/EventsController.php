<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    public function getEvents()
    {
        return response()->json([
            'message' => 'Events fetched successfully',
            'events' => Event::all(),
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
}
