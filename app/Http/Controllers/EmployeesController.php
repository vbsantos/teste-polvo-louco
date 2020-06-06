<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Employee;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([ // REVIEW Input validation
            'firstname' => ['required','max:255'],
            'lastname' => ['required','max:255'],
            'company_id' => ['required','exists:App\Company,id','max:255'],
            'email' => ['required','unique:App\Employee,email','email:rfc,dns','max:255'],
            'phone' => ['max:15'],
        ]);
        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        return view('employees.edit');
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
        $request->validate([ // REVIEW Input validation
            'firstname' => ['required','max:255'],
            'lastname' => ['required','max:255'],
            'company_id' => ['required','exists:App\Company,id','max:255'],
            'email' => ['required','unique:App\Employee,email','email:rfc,dns','max:255'],
            'phone' => ['max:15'],
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
        $employee = Employee::findOrFail($id);
        return $employee->delete();
    }
}
