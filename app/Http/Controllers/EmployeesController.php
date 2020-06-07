<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Employee;
use App\Company;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info("EmployeesController@index");
        $employees = Employee::paginate(10);
        return view('employees.index')->with("employees", $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info("CompaniesController@create");
        $companies = Company::all();
        return view('employees.create')->with("companies", $companies);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info("EmployeesController@store: ". json_encode($request->all()));
        $request->validate([
            'firstname' => ['required','max:255'],
            'lastname' => ['required','max:255'],
            'company_id' => ['required','exists:App\Company,id','max:255'],
            'email' => ['required','unique:App\Employee,email','email:rfc,dns','max:255'],
            'phone' => ['min:8','max:15'],
        ]);
        $employee = Employee::create($request->all());
        if (isset($employee)) {
            return redirect('/employees');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info("EmployeesController@show: ".$id);
        $employee = Employee::findOrFail($id);
        return $employee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info("EmployeesController@edit: ".$id);
        $employee = Employee::findOrFail($id);
        return view('employees.edit')->with("employees", $employees);
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
        Log::info("EmployeesController@update: [".$id."] ".json_encode($request->all()));
        $request->validate([
            'firstname' => ['required','max:255'],
            'lastname' => ['required','max:255'],
            'company_id' => ['required','exists:App\Company,id','max:255'],
            'email' => ['required','unique:App\Employee,email','email:rfc,dns','max:255'],
            'phone' => ['min:8','max:15'],
        ]);
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Log::info("EmployeesController@delete: ".$id);
        $employee = Employee::findOrFail($id);
        return $employee->delete();
    }
}
