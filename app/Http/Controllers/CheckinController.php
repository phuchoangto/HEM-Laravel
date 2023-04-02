<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Student;
use Illuminate\Http\Request;
use League\Csv\Writer;
use DateTime;

class CheckinController extends Controller
{
    public function showStudents($id)
    {
        $event = Event::find($id);
        if (!$event) {
            abort(404, 'Event not found');
        }
        //get students paginate 5 with pivot
        $students = $event->students()->paginate(5);
        return view('dashboard.checkin', compact('event', 'students'));
    }

    public function exportStudents($id)
    {
        $event = Event::find($id);
        if (!$event) {
            abort(404, 'Event not found');
        }

        $students = $event->students()->withPivot('check_in_at')->get();
        $csv = Writer::createFromString('');
        $csv->setOutputBOM(Writer::BOM_UTF8); // add BOM to the CSV file
        $csv->insertOne(['id', 'name', 'email', 'check_in_at', 'event_name']);
        foreach ($students as $student) {
            $checkInDate = new DateTime($student->pivot->check_in_at);
            $csv->insertOne([
                $student->id,
                $student->name,
                $student->email,
                $checkInDate->format('Y-m-d H:i:s'),
                $event->name
            ]);
        }

        $filename = 'students_' . $event->name . '_' . date('YmdHis') . '.csv';

        return response($csv->toString(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    //Certificate
    public function exportCertificate($id)
    {
        $event = Event::find($id);
        if (!$event) {
            abort(404, 'Event not found');
        }
        $students = $event->students()->withPivot('check_in_at')->get();
        $csv = Writer::createFromString('');
        $csv->setOutputBOM(Writer::BOM_UTF8); // add BOM to the CSV file
        $csv->insertOne(['id', 'name', 'email', 'check_in_at', 'event_name']);
        foreach ($students as $student) {
            $checkInDate = new DateTime($student->pivot->check_in_at);
            $csv->insertOne([
                $student->id,
                $student->name,
                $student->email,
                $checkInDate->format('Y-m-d H:i:s'),
                $event->name
            ]);
        }
        $filename = 'students_' . $event->name . '_' . date('YmdHis') . '.csv';

        return response($csv->toString(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
