<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckInRequest;
use App\Models\Event;
use App\Models\Student;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getAll(Request $request)
    {
        $events = Event::all();

        return response()->json(['data' => $events], 200);
    }

    public function get(Request $request, $id)
    {
        $event = Event::find($id);

        if ($event) {
            return response()->json(['data' => $event], 200);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    public function checkIn(CheckInRequest $request, $id)
    {
        $event = Event::find($id);

        if ($event) {
            if ($event->end_at < now()) {
                return response()->json(['error' => 'Event has ended'], 400);
            }

            $student_id = $request->only('student_id');

            $student = Student::where('student_id', $student_id)->first();

            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }

            if ($event->students()->where('id', $student->id)->exists()) {
                return response()->json(['error' => 'Student already checked in'], 400);
            }

            $event->students()->attach($student);

            return response()->json(['message' => 'Student checked in'], 200);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }
}
