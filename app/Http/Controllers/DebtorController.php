<?php

namespace App\Http\Controllers;

use App\Debtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $debtors = Debtor::first()->book()->get();
        $debtors = Debtor::with(['student'])->orderBy('created_at', 'desc')->paginate();
        // $debtors = $debtors->countBy('student_id');
        // return $debtors;
        // $debtors->all();

        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();

        // $debtors = DB::table('debtors')
        //     ->select('students.firstname', 'students.lastname', 'students.group')
        //     ->join('students', 'debtors.student_id', '=', 'students.id')
        //     ->groupBy('students.firstname')
        //     ->get();
        // return $debtors;

        return view('admin.debtors', ['debtors'=> $debtors]);
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
    public function show(Debtor $debtor)
    {
        //
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
