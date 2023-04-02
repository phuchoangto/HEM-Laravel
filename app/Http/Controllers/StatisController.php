<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Event;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;

class StatisController extends Controller
{
    public function index()
    {
        return view('dashboard.statis');
    }
    //get all event count
    public function getEventCount()
    {
        $eventCount = Event::all()->count();
        return response()->json($eventCount);
    }
    //get all event with start_at > now
    public function getEventCountUpcoming()
    {
        $eventCountUpcoming = Event::where('start_at', '>', now())->count();
        return response()->json($eventCountUpcoming);
    }
    public function getEventCountCurrent()
    {
        $eventCountCurrent = Event::where('start_at', '<', now())->where('end_at', '>', now())->count();
        return response()->json($eventCountCurrent);
    }
    //getCheckinCount 
    public function getCheckinCount()
    {
        $checkinCount = Checkin::all()->count();
        return response()->json($checkinCount);
    }
    //getStudentCount
    public function getStudentCount()
    {
        $studentCount = Student::all()->count();
        return response()->json($studentCount);
    }
    //getFacultyCount
    public function getFacultyCount()
    {
        $facultyCount = Faculty::all()->count();
        return response()->json($facultyCount);
    }
}
