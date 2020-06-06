<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'name' => ['required','max:255'],
            'email' => ['required','unique:App\Company,email','email:rfc,dns','max:255'],
            'site' => ['url','max:255'],
            'logo' => ['dimensions:min_width=100, min_height=100'], // REVIEW image validation
        ]);
        return $valid;
        $company = Company::create($request->all());
        return response()->json($company, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return $company;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('companies.edit');
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
            'name' => ['required','max:255'],
            'email' => ['required','unique:App\Company,email','email:rfc,dns','max:255'],
            'site' => ['url','max:255'],
            'logo' => ['dimensions:min_width=100, min_height=100'], // REVIEW image validation
        ]);
        $company = Company::findOrFail($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->site = $request->site;
        $company->logo = $request->logo;
        $company->save();
        return $company;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $company = Company::findOrFail($id);
        return $company->delete();
    }
}
