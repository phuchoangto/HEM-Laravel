<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEventRequest;
use App\Http\Requests\EditEventRequest;
use App\Models\Event;
use App\Models\Faculty;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PharIo\Manifest\Url;

class EventController extends Controller
{
    public function show($id)
    {
        $event = Event::find($id);
        return view('event.show', ['event' => $event]);
    }

    public function editEvent(Request $request, $id)
    {
        if ($request->start_at > $request->end_at)
            if (!$request->hasFile('image')) {
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
            } else {
                $event = Event::find($id);
                $event->name = $request->name;
                $event->description = $request->description;
                $event->location = $request->location;
                $event->start_at = $request->start_at;
                $event->end_at = $request->end_at;

                if ($request->hasFile('image')) {
                    $name = $request->file('image')->getClientOriginalName();
                    $request->file('image')->storeAs('images/events',  $name);
                    $event->image = 'images/events/' . $name;
                } else {
                    $event->image = 'null';
                }
                $event->faculty_id = $request->faculty_id;
                $event->save();
                return response()->json([
                    'message' => 'Event edited successfully',
                    'event' => $event
                ]);
            }
        else {
            return response()->json([
                'message' => 'Event edited failed',
            ]);
        }
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
    public function addEvent(Request $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_at = $request->start_at;
        $event->end_at = $request->end_at;
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/events', $name);
            $event->image = 'images/events/' . $name;
        } else {
            $event->image = 'null';
        }
        $event->faculty_id = $request->faculty_id;
        $event->save();
        return response()->json([
            'message' => 'Event added successfully',
            'event' => $event
        ]);
    }
    //addEventview
    public function addEventView()
    {
        $faculties = Faculty::all();
        return view('dashboard.addEventView', ['faculties' => $faculties]);
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $fileName = $request->file('upload')->getClientOriginalName();
            $request->file('upload')->storeAs('images/description',   $fileName);
            $url = Storage::Url('images/description/') .  $fileName;
            return response()->json([
                'fileName' => $fileName,
                'uploaded' => 1,
                'url' => $url,
            ]);
        }
    }
}
