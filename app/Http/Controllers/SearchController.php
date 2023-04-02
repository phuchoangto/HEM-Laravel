<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $checkins = Checkin::all();
        return view('home.search', ['checkins' => $checkins]);
    }


    public function search(Request $request)
    {
        $search = $request->search;
        if ($request->search != null)
            $checkins = Checkin::whereHas('student', function ($query) use ($search) {
                $query->where('student_id', $search);
            })->with('student', 'event')->get();
        else
            $checkins = Checkin::all();
        return view('home.search', ['checkins' => $checkins]);
    }
}
