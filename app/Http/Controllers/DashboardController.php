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
        $events = Event::all();
        return view('dashboard.event', ['events' => $events]);
    }

    public function student()
    {
        $students = Student::all(); 
        return view('dashboard.student', ['students' => $students]);
    }

    public function user()
    {
        $users = User::all();
        return view('dashboard.user', ['users' => $users]);
    }
}