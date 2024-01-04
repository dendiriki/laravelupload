<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dep;

class DepController extends Controller
{
    public function index()
    {
        $deps = Dep::all();
        return view('dep.index', compact('deps'));
    }

    public function create()
    {
        // Tambahkan logic untuk mengambil data yang diperlukan
        return view('dep.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short' => 'required',
        ]);

        Dep::create($request->all());

        return redirect()->route('dep.index')->with('success', 'Dep created successfully.');
    }

    public function edit($id)
    {
        $dep = Dep::find($id);

        if (!$dep) {
            return redirect()->route('dep.index')->with('error', 'Department not found.');
        }

        return view('dep.edit', compact('dep'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'short' => 'required',
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

