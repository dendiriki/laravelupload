<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocDept;
use App\Models\Dep;
use App\Models\Document;

class DocDeptController extends Controller
{
    public function index()
    {
        $docDepts = DocDept::with(['document', 'dep'])->get();
        return view('docdept.index', compact('docDepts'));
    }

    public function create()
    {
        $documents = Document::all();
        $deps = Dep::all();
        return view('docdept.create', compact('documents', 'deps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doc_id' => 'required',
            'dep_id' => 'required',
        ]);

        DocDept::create($request->all());

        return redirect()->route('docdept.index')->with('success', 'Doc Dept created successfully.');
    }
}
