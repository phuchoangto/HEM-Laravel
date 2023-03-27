<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\EditStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //add student
    public function addStudent(AddStudentRequest $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->student_id = $request->student_id;
        $student->faculty_id = $request->faculty_id;
        $student->save();
        return response()->json([
            'message' => 'Student added successfully',
            'student' => $student
        ]);
    }

    //edit
    public function editStudent(EditStudentRequest $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->student_id = $request->student_id;
        $student->faculty_id = $request->faculty_id;
        $student->save();
        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student
        ]);
    }

    public function getOne($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    //delete
    public function deleteStudent($id)
    {
        $student = Student::find($id);
        $student->is_archive = true;
        $student->save();
        return response()->json([
            'message' => 'Student deleted successfully',
            'student' => $student
        ]);
    }
}
