<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        Log::info("CompaniesController@index");
        $companies = Company::paginate(10);
        return view('companies.index')->with("companies", $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info("CompaniesController@create");
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
        Log::info("CompaniesController@store: ". json_encode($request->all()));
        $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','unique:App\Company,email','email:rfc,dns','max:255'],
            'site' => ['url','max:255'],
            'logo' => ['dimensions:min_width=100, min_height=100'],
        ]);
        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->site = $request->input('site');
        $logo = $request->file('logo');
        if (isset($logo)) {
            $filepath = $request->file('logo')->store('images', 'public');
            $company->logo = $filepath;
        } else {
            $company->logo = '';
        }
        $company->save();
        if (isset($company)) {
            return redirect('/companies');
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
        Log::info("CompaniesController@show: ".$id);
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
        Log::info("CompaniesController@edit: ".$id);
        $company = Company::findOrFail($id);
        return view('companies.edit')->with("companies", $companies);
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
        Log::info("CompaniesController@update: [".$id."] ".json_encode($request->all()));
        $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','unique:App\Company,email','email:rfc,dns','max:255'],
            'site' => ['url','max:255'],
            'logo' => ['dimensions:min_width=100, min_height=100'],
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
        Log::info("CompaniesController@delete: ".$id);
        $company = Company::findOrFail($id);
        return $company->delete();
    }
}
