<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dep;
use App\Models\Company;

class DepController extends Controller
{
    public function index()
    {
        $deps = Dep::with('company')->paginate(20);
        return view('dep.index', compact('deps'));
    }


    public function create()
    {
        $companies = Company::all(); // Mengambil semua perusahaan
        return view('dep.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short' => 'required',
            'com_id' => 'required|exists:company,id', // Validasi com_id
        ]);

        Dep::create($request->all());

        return redirect()->route('dep.index')->with('success', 'Dep created successfully.');
    }

    public function edit($id)
    {
        $dep = Dep::find($id);
        $companies = Company::all(); // Mengambil semua perusahaan

        if (!$dep) {
            return redirect()->route('dep.index')->with('error', 'Department not found.');
        }

        return view('dep.edit', compact('dep', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'short' => 'required',
            'com_id' => 'required|exists:company,id', // Validasi com_id
        ]);

        $dep = Dep::find($id);

        if (!$dep) {
            return redirect()->route('dep.index')->with('error', 'Department not found.');
        }

        $dep->update($request->all());

        return redirect()->route('dep.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $dep = Dep::find($id);

        if (!$dep) {
            return redirect()->route('dep.index')->with('error', 'Department not found.');
        }

        $dep->delete();

        return redirect()->route('dep.index')->with('success', 'Department deleted successfully.');
    }



}

