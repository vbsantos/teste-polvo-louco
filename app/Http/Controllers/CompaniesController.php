<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        Log::info("CompaniesController@index");

        $companies = Company::paginate(10);
        return view('companies.index')->with("companies", $companies);
    }

    public function create()
    {
        Log::info("CompaniesController@create");

        return view('companies.create');
    }

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
        if ($request->hasFile('logo')) {
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

    public function show($id)
    {
        Log::info("CompaniesController@show: ".$id);

        $company = Company::findOrFail($id);
        return $company;
    }

    public function edit($id)
    {
        Log::info("CompaniesController@edit: ".$id);

        $company = Company::findOrFail($id);
        return view('companies.edit')->with("company", $company);
    }

    public function update(Request $request, $id)
    {
        Log::info("CompaniesController@update: [".$id."] ".json_encode($request->all()));

        $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email:rfc,dns','max:255'],
            'site' => ['url','max:255'],
            'logo' => ['dimensions:min_width=100, min_height=100'],
        ]);

        $company = Company::findOrFail($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->site = $request->site;
        if ($request->hasFile('logo')) {
            $oldImage = $company->logo; // REVIEW remover imagem anterior?
            unlink(public_path('storage/') . $oldImage);
            $path = $request->file('logo')->store('images', 'public');
            $company->logo = $path;
            $company->save();
        }
        $company->save();
        if (isset($company)) {
            return redirect('/companies');
        }
    }

    public function delete($id)
    {
        Log::info("CompaniesController@delete: ".$id);

        $company = Company::findOrFail($id);
        $company->delete();
        return redirect('/companies');
    }
}
