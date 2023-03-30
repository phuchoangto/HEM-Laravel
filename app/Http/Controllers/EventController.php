<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEventRequest;
use App\Http\Requests\EditEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show($id)
    {
        $event = Event::find($id);
        return view('event.show', ['event' => $event]);
    }

    public function editEvent(EditEventRequest $request, $id)
    {
        $event = Event::find($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_at = $request->start_at;
        $event->end_at = $request->end_at;
        $event->faculty_id = $request->faculty_id;
        $event->save();
        return response()->json([
            'message' => 'Event edited successfully',
            'event' => $event
        ]);
    }

    //getOne
    public function getOneEvent($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    //delete
    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->is_archive = true;
        $event->save();
        return response()->json([
            'message' => 'Event deleted successfully',
            'event' => $event
        ]);
    }

    //addEventview
    public function addEventView()
    {
        return view('dashboard.addEventView');
    }
}
