<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = DB::table('expenses')->get();
        return response()->Json($expenses);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'details' => ['required'],
            'amount' => ['required'],
        ]);

        $data = array();
        $data['details'] = $request->details;
        $data['amount'] = $request->amount;
        $data['expense_date'] = date('d/m/y');

        DB::table('expenses')->insert($data);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = DB::table('expenses')->where('id',$id)->first();
        return response()->Json($expense);
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
        $validatedData = $request->validate([
            'details' => ['required'],
            'amount' => ['required'],
        ]);

        $data = array();
        $data['details'] = $request->details;
        $data['amount'] = $request->amount;

        DB::table('expenses')->where('id',$id)->update($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('expenses')->where('id',$id)->delete();
    }
}
