<?php

// app/Http/Controllers/CompanyController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'short' => 'required|string',
        ]);

        Company::create($request->all());

        return redirect()->route('company.index')->with('success', 'Company created successfully!');
    }

    public function edit($id)

    {
        $company = Company::find($id);
        return view('company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);

        $company->update($request->all());

        return redirect()->route('company.index')->with('success', 'Company updated successfully!');
    }

    public function destroy($id)
    {
        $company = company::find($id);

        $company->delete();

        return redirect()->route('company.index')->with('success', 'Company deleted successfully!');
    }
}
