<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('admin.students', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        try {
            $student = new Student($request->all());
            $student->password = Hash::make($request->password); 
            if($request->hasFile('image'))
            {
                $path = $request->image->store('images', 'public');
                $student->image = $path;
            }
            $student->save();
            return redirect('students')->with('status', 'Student added !!!');
       } catch (\Throwable $th) {
           throw $th;
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('admin.edit_student', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        try {
            $path = $student->image;
            $student->update($request->all());
            if($request->hasFile('image'))
            {
                if($path != 'images/default_student.png')
                Storage::delete('public/' . $path);
                $path = $request->image->store('images', 'public');
                $student->image = $path;
                $student->save();
            }
            return redirect('students')->with('status', 'Student has been updated successfully !!!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $path = $student->image;
        if($path != 'images/default_student.png')
        Storage::delete('public/' . $path);
        $student->delete();
        return redirect('students')->with('status', 'Student has been deleted successfully !!!');
    }

    public function checkAuth(Request $request)
    {
        $student = Student::findOrFail($request->student_id);
        if (Hash::check($request->password, $student->password)) {
            return [
                'status' => true
            ];
        } else {
            return [
                'status' => false
            ];
        }
    }
}
