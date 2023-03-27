<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        return view('dashboard.event', ['events' => $events]);
    }

    public function student()
    {
        $students = Student::paginate(5);
        return view('dashboard.student', ['students' => $students]);
    }

    public function user()
    {
        $users = User::paginate(5);
        return view('dashboard.user', ['users' => $users]);
    }

}