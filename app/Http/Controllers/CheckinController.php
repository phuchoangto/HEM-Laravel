<?php 
    namespace App\Http\Controllers; 
    use App\Models\Event;
    use App\Models\Student;
    use Illuminate\Http\Request;
    

    class CheckinController extends Controller 
    { 
        public function showStudents($id){
            $event = Event::find($id);
            if (!$event) {
                abort(404, 'Event not found');
            }
            //get students paginate 5 with pivot
            $students = $event->students()->paginate(5);
            return view('dashboard.checkin', compact('event', 'students'));
        }
        
    }
