<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\User;
use App\Models\Company;

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
        $request->validate([
            // Tambahkan validasi yang diperlukan
        ]);

        Type::create([
            'description' => $request->description,
            'short' => $request->short,
            'dt_created_date' => now(),
            'vc_created_user' => $request->vc_created_user,
            'dt_modified_date' => now(),
            'vc_modified_user' => $request->vc_created_user,
            'comp_id' => $request->comp_id,
        ]);

        return redirect()->route('types.index')->with('success', 'Type created successfully!');
    }
}
