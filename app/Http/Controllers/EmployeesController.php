<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Employee;
use App\Company;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        Log::info("EmployeesController@index");
        $employees = Employee::paginate(10);
        $companies = Company::all();
        return view('employees.index')->with("employees", $employees)->with("companies", $companies);
    }

    public function create()
    {
        Log::info("CompaniesController@create");

        $companies = Company::all();
        return view('employees.create')->with("companies", $companies);
    }

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

    public function show($id)
    {
        Log::info("EmployeesController@show: ".$id);

        $employee = Employee::findOrFail($id);
        return $employee;
    }

    public function edit($id)
    {
        Log::info("EmployeesController@edit: ".$id);

        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        return view('employees.edit')->with("companies", $companies)->with("employee", $employee);
    }

    public function update(Request $request, $id)
    {
        Log::info("EmployeesController@update: [".$id."] ".json_encode($request->all()));

        $request->validate([
            'firstname' => ['required','max:255'],
            'lastname' => ['required','max:255'],
            'company_id' => ['required','exists:App\Company,id','max:255'],
            'email' => ['required','email:rfc,dns','max:255'],
            'phone' => ['min:8','max:15',],
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        if (isset($employee)) {
            return redirect('/employees');
        }
    }

    public function delete($id)
    {
        Log::info("EmployeesController@delete: ".$id);

        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect('/employees');
    }
}
