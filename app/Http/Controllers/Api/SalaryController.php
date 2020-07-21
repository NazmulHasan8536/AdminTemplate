<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SalaryController extends Controller
{

    public function paid(Request $request, $id)
    {
        $validatedData = $request->validate([
            'salary_given' => ['required'],
        ]);

        $month = $request->salary_given;
        $check = DB::table('salaries')->where('employee_id',$id)->where('salary_given',$month)->first();
        if ($check) {
            return response()->Json('Salaries aLready Paid');
        }else{
            $data = array();
            $data['employee_id'] = $id;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['salary_given'] = $month;
            $data['salary_date'] = date('d/m/y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('y');

            DB::table('salaries')->insert($data);
        }

    }





}
