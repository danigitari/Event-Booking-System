<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

class AdminController extends Controller
{
    public function getUsers()
    {

        $users = User::with('roles')->get();


        return response()->json([
            'users' => $users,
            'current_user' => auth()->user(),


        ]);
    }

    public function addNewAdmin(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ])->assignRole('admin');
    }

    public function createEvent(Request $request)
    {
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            // 'image' => $request->image,
            'max_attendees' => $request->max_attendees,
            'vip_price' => $request->vip_price,
            'regular_price' => $request->regular_price,


        ]);

        return response()->json([
            'event' => $event,
            'message' => 'Event created successfully'
        ]);
    }

    public function editEvent(Request $request)
    {
  
        $event = Event::find($request->id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->location = $request->location;
        // $event->image = $request->image;
        $event->max_attendees = $request->max_attendees;
        $event->vip_price = $request->vip_price;
        $event->regular_price = $request->regular_price;
        $event->update();

        return response()->json([
            'message' => 'Event Updated Successfully',
        ]);
    }
    public function deleteEvent(Request $request)
    {
        $event = Event::find($request->id);
        $event->delete();

        return response()->json([
            'message' => 'Event Deleted Successfully',
        ]);
    }
}
