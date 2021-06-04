<?php

namespace App\Http\Controllers;

use App\Debtor;
use App\Student;
use App\Exports\DebtorsExportView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::has('debts')->with('debts')->paginate();
        // return  $students;
        return view('admin.debtors', ['students'=> $students]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student, $books)
    {
        
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
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $books = [];
        foreach ($student->debts as $debt) {
            array_push($books, $debt->book);
        }
        return view('admin.debtors_show', ['student'=>$student, 'books'=>$books]);
    }

    public function export()
    {
        return Excel::download(new DebtorsExportView(), 'debtors.xlsx');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Debtor $debtor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debtor $debtor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debtor $debtor)
    {
        //
    }
}
