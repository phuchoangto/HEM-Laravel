<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function event()
    {
        $events = Event::paginate(5);
        $faculties = Faculty::all();
        return view('dashboard.event', ['events' => $events, 'faculties' => $faculties]);
    }

    public function student()
    {
        $students = Student::where('is_archive', false)->paginate(5);
        $faculties = Faculty::all();
        return view('dashboard.student', ['students' => $students, 'faculties' => $faculties]);
    }

    public function user()
    {
        $users = User::paginate(5);
        return view('dashboard.user', ['users' => $users]);
    }
}
