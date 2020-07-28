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
            $data['amount'] = $request->salary;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
//            $data['salary_given'] = $month;
            $data['salary_date'] = date('d/m/y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('y');

            DB::table('salaries')->insert($data);
        }
    }

    public function allSalary(){
        $salary = DB::table('salaries')->select("salary_month")->groupBy('salary_month')->get();
        return response()->Json($salary);
    }


public function viewSalary($id){
        $month = $id;
        $view = DB::table('salaries')
                ->join('employees','salaries.employee_id','employees.id')
                ->select('employees.name','employees.salary','salaries.*')
                ->where('salaries.salary_month',$month)
                ->get();
    return response()->Json($view);
}

public function editSalary($id){
    $view = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name','employees.email','salaries.*')
        ->where('salaries.salary_month',$id)
        ->first();
    return response()->Json($view);
}

public function updateSalary(Request $request,$id){
    $data = array();
    $data['employee_id'] = $request->employee_id;
    $data['amount'] = $request->salary;
    $data['salary_month'] = $request->salary_month;
    DB::table('salaries')->where('id',$id)->update($data);
}

//stock
public function updateStock(Request $request,$id){
    $validatedData = $request->validate([
        'product_quantity' => ['required'],
    ]);
    $data = array();
    $data['product_quantity'] = $request->product_quantity;
    DB::table('products')->where('id',$id)->update($data);
}


}
