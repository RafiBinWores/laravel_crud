<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('id','DESC')->paginate(5);

        return view('student.index', ['students' => $students]);
    }

    //get create student info file
    public function create()
    {
        return view('student.create');
    }

    //store student info
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,jpg'
        ]);

        if ($validator) {

            $extension = $request->image->extension();
            $newFileName = time() . '.' . $extension;
            $request->image->move(public_path() . '/uploads/students/', $newFileName);

            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->address = $request->address;
            $student->image = $newFileName;
            $student->save();

            $request->session()->flash('success', 'Student added successfully.');

            return redirect()->route('student.index');
        } else {
            return redirect()->round('student.create')->withErrors($validator)->withInput();
        }
    }
}
