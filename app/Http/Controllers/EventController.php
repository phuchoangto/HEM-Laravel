<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show($id)
    {
        $event = Event::find($id);
        return view('event.show', ['event' => $event]);
    }

    //add Event
    public function addEvent(AddEventRequest $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->image = $request->image;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->save();
        return response()->json([
            'message' => 'Event added successfully',
            'event' => $event
        ]);
    }
}
