<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('start_at', '>', Carbon::now())->paginate(6);
        return view('home.index', ['events' => $events]);
    }
}
