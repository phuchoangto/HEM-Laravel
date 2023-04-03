<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $checkins = Checkin::query();
        $flag = false;
        if ($request->has('search')) {
            $search = $request->search;
            $checkins->whereHas('student', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        $checkins = $checkins->with('student', 'event')->paginate(0);

        return view('home.search', ['checkins' => $checkins, 'flag' => $flag]);
    }


    public function search(Request $request)
    {
        $flag = false;
        $search = $request->search;
        if ($request->search != null) {
            $checkins = Checkin::whereHas('student', function ($query) use ($search) {
                $query->where('student_id', $search);
            })->with('student', 'event')->paginate(6);
            $flag = true;
        } else {
            $checkins = Checkin::with('student', 'event')->paginate(6);
        }

        return view('home.search', ['checkins' => $checkins, 'flag' => $flag]);
    }
}
