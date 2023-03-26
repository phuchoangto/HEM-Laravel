<?php

namespace App\Http\Controllers;

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
        return view('dashboard.event');
    }

    public function student()
    {
        return view('dashboard.student');
    }

    public function user()
    {
        $users = User::all();
        return view('dashboard.user', ['users' => $users]);
    }
}