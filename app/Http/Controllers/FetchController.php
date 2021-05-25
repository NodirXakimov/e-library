<?php

namespace App\Http\Controllers;

use App\Student;
use App\Book;
use App\Debtor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BookImport;
use App\Imports\StudentImport;

class FetchController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return $students;
    }

    public function search(Request $request)
    {
        $queryString = $request->searchValue;
        $result = Student::where('firstname', 'LIKE', "%$queryString%")->orderBy('firstname')->get();
        return $result;
    }

    public function create()
    {
        //
    }
    
    public function getStudent(Request $request)
    {
        // $request->validate([
        //     'id' => 'required',
        // ]);
        $id = $request->id;
        $student = Student::findOrFail($id);
        return $student;
    }

    public function getBook(Request $request)
    {
        // $request->validate([
        //     'id' => 'required',
        // ]);
        $id = $request->id;
        $book = Book::findOrFail($id);
        return $book;
    }

    public function attach(Request $request)
    {
        try {
            $len = sizeof($request->books);
            $today = Carbon::now();
            $expiration_date = $today->addDays(30);
            foreach ($request->books as $key => $book) {
                Debtor::create([
                    'student_id' => $request->student_id,
                    'book_id' => $book["id"],
                    'expiration_date' => $expiration_date
                ]);
            }
        return $request->student_id;
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public function importBook(Request $request)
    {
        $books = Excel::import(new BookImport(), $request->file('file'));
        return redirect()->route('books.index');
    }

    public function importStudent(Request $request)
    {
        $students = Excel::import(new StudentImport(), $request->file('file'));
        return redirect()->route('students.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
