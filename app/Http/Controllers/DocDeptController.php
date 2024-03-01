<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocDept;
use App\Models\Dep;
use App\Models\Document;
use Illuminate\Support\Facades\DB;

class DocDeptController extends Controller
{
    public function index()
    {
        $docDepts = DocDept::whereHas('document', function ($query) {
            $query->whereExists(function ($subquery) {
                $subquery->select(DB::raw(1))
                    ->from('mst_document')
                    ->whereColumn('mst_document.id', 'doc_dept.doc_id');
            });
        })
        ->orderBy('id', 'desc')
        ->filter()
        ->paginate(6);
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

    public function destroy($id)
    {
        $docDept = DocDept::findOrFail($id);
        $docDept->delete();

        return redirect()->route('docdept.index')->with('success', 'Doc Dept deleted successfully.');
    }
}
