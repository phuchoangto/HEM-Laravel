<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use League\Csv\Writer;
use DateTime;
use TCPDF;

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
    public function exportPDF($id)
    {
        $pdf = Pdf::loadView(
            'home.sample'
        );
        return $pdf->download('certificate.pdf');
    }
    public function exportCertificate($event_id, $student_id)
    {
        $student = Student::find($student_id);
        $studentpivot = Student::find($student_id)->events()->where('id', $event_id)->first()->pivot;
        if (!$student) {
            abort(404, 'Student not found');
        }
        $event = Event::find($event_id);
        if (!$event) {
            abort(404, 'Event not found');
        }

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->SetFont('times', '', 12);
        $html = View::make('home.sample', [
            'check_in_at' => $studentpivot->check_in_at,
            'event' => $event,
            'student' => $student
        ])->render();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('example.pdf', 'D');
    }
}
