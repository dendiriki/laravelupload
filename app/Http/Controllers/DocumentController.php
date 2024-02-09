<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ISO;
use App\Models\Type;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use App\Models\Dep;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    public function index()
    {
        $isos = ISO::all();
        $documents = Document::with(['type', 'iso', 'createdBy', 'company'])
            ->orderBy('dt_created_date', 'desc')->filter()
            ->paginate(6);

        return view('documents.index', compact('documents', 'isos'));
    }

    public function create()
    {
        $deps = Dep::all();
        $types = Type::all();
        $isos = ISO::all();
        $users = User::all();
        $companies = Company::all();

        return view('documents.create', compact('types', 'isos', 'users', 'companies','deps'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'iso_id' => 'required',
            'dt_modified_date' => 'required',
            'doc_name' => ['required', Rule::unique('mst_document')],
        ]);

        $validator->after(function ($validator) use ($request) {
            $exists = Document::where('description', $request->description)
                              ->where('iso_id', $request->iso_id)
                              ->exists();
            if ($exists) {
                $validator->errors()->add('description_iso_id', 'The combination of document name and ISO ID must be unique.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('customError', 'The combination of document name and ISO ID must be unique.');
        }


        $folderDoc = preg_replace('/[^a-zA-Z0-9]/', '_', $request->description);
        $iso = ISO::where('id', $request->iso_id)->value('path');
        $folderPath = "uploads/" . $iso . "/" . $folderDoc;

        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }

        $user = Auth::user();
        $documentData = $request->only(['description', 'iso_id', 'dt_modified_date', 'doc_name']) + [
            'doctype_id' => $request->doctype_id,
            'dt_created_date' => now(), // Assuming now() is the creation time
            'vc_created_user' => $user->code_emp,
            'dt_modified_date' => $request->dt_modified_date,
            'vc_modified_user' => $user->code_emp,
            'comp_id' => $user->comp_id,
            'path' => $folderPath,
            'dep_terkait' => $request->dep_terkait,
        ];

        Document::create($documentData);

        return redirect()->route('documents.index')->with('success', 'Document created successfully!');
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $deps = Dep::all();
        $types = Type::all();
        $isos = ISO::all();
        $users = User::all();
        $companies = Company::all();

        return view('documents.edit', compact('document', 'types', 'isos', 'users', 'companies', 'deps'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doc_name' => [
                'required',
                Rule::unique('documents')->ignore($id),
            ],
        ]);

        $validator->after(function ($validator) use ($request, $id) {
            $exists = Document::where('description', $request->description)
                              ->where('iso_id', $request->iso_id)
                              ->where('id', '!=', $id)
                              ->exists();
            if ($exists) {
                $validator->errors()->add('description_iso_id', 'The combination of description and ISO ID must be unique.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $document = Document::findOrFail($id);
        $user = Auth::user();
        $updateData = $request->only(['description', 'iso_id', 'dt_modified_date', 'doc_name']) + [
            'doctype_id' => $request->doctype_id,
            'dt_modified_date' => now(), // Assuming now() is the update time
            'vc_modified_user' => $user->code_emp,
            'comp_id' => $user->comp_id,
            'dep_terkait' => $request->dep_terkait,
        ];

        $document->update($updateData);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::deleteDirectory($document->path);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully!');
    }

    public function fetchDataForApi()
    {
        $documents = Document::all();
        return response()->json($documents)
                         ->header('Access-Control-Allow-Origin', '*')
                         ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
