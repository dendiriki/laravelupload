@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Doc Dept</h2>
        <form method="POST" action="{{ route('docdept.store') }}">
            @csrf
            <div class="mb-3">
                <label for="doc_id" class="form-label">Document</label>
                <select name="doc_id" id="doc_id" class="form-control" onfocus='this.size=8;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    @foreach ($documents as $document)
                        <option value="{{ $document->id }}">{{ $document->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="dep_id" class="form-label">Department</label>
                <select name="dep_id" id="dep_id" class="form-control" onfocus='this.size=8;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    @foreach ($deps as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
