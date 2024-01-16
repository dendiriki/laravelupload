<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::all(); // Ambil semua data tipe
        return view('types.index', compact('types'));
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        return view('types.create', compact('users', 'companies'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        Type::create([
            'description' => $request->description,
            'short' => $request->short,
            'dt_created_date' => now(),
            'vc_created_user' => $user->code_emp, // Menggunakan username dari user yang login
            'dt_modified_date' => now(),
            'vc_modified_user' => $user->code_emp, // Menggunakan username dari user yang login
            'comp_id' => $user->comp_id, // Menggunakan comp_id dari user yang login
        ]);

        return redirect()->route('types.index')->with('success', 'Type created successfully!');
    }

    // Tambahkan fungsi edit
    public function edit($id)
    {
        $type = Type::find($id);
        $users = User::all();
        $companies = Company::all();
        return view('types.edit', compact('type', 'users', 'companies'));
    }

    // Tambahkan fungsi update
    public function update(Request $request, $id)
    {

        $user = Auth::user();
        $type = Type::find($id);

        $type->update([
            'description' => $request->description,
            'short' => $request->short,
            'dt_modified_date' => now(),
            'vc_modified_user' => $user->code_emp, // Menggunakan username dari user yang login
            'comp_id' => $user->comp_id, // Menggunakan comp_id dari user yang login
        ]);

        return redirect()->route('types.index')->with('success', 'Type updated successfully!');
    }

    // Tambahkan fungsi destroy
    public function destroy($id)
    {
        Type::destroy($id);
        return redirect()->route('types.index')->with('success', 'Type deleted successfully!');
    }

}
