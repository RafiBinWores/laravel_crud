<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

            // option 1
            // $student = new Student();
            // $student->name = $request->name;
            // $student->email = $request->email;
            // $student->address = $request->address;
            // $student->image = $newFileName;
            // $student->save();

            // // optimized option 1
            // $student = new Student();
            // $student->fill($request->post())->save();

            //optimized option 2 but it don't work with image
            $student = Student::create($request->post())->save();

            //image upload
            if($request->image){

                $extension = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $extension;
                $request->image->move(public_path() . '/uploads/students/', $newFileName);

                $student->image = $newFileName;
                $student->save();
            }

            return redirect()->route('student.index')->with('success', 'Student added successfully.');
        } else {
            return redirect()->round('student.create')->withErrors($validator)->withInput();
        }
    }

    //get edit page
    public function edit(Student $student){

        // $student = Student::findOrFail($id);

        return view('student.edit', ['student'=> $student]);
    }

    //put updated student
    public function update(Student $student, Request $request){

        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,jpg'
        ]);

        if ($validator) {

            // $student = Student::find($id);
            // $student->name = $request->name;
            // $student->email = $request->email;
            // $student->address = $request->address;
            // $student->save();

            //optimized way
            $student->fill($request->post())->save();

            if($request->image){

                $oldImage = $student->image;

                $extension = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $extension;
                $request->image->move(public_path() . '/uploads/students/', $newFileName);

                $student->image = $newFileName;
                $student->save();

                File::delete(public_path() . '/uploads/students/', $oldImage);
            }

            return redirect()->route('student.index')->with('success', 'Student updated successfully.');
        } else {
            return redirect()->round('student.edit', $student->id)->withErrors($validator)->withInput();
        }
    }

    //get student
    public function destroy(Student $student, Request $request){

        // $student = Student::findOrFail($id);
        File::delete(public_path() . '/uploads/students/', $student->image);
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student Deleted Successfully');
    }
}
