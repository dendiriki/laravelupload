@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Edit Doc PDF</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('documents.update', $document->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="description" class="form-label">Name Doc</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ $document->description }}">
            </div>

            <div class="mb-3">
                <label for="doc_name" class="form-label">Nomer Doc</label>
                <input type="text" name="doc_name" class="form-control" id="doc_name" value="{{ $document->doc_name }}">
            </div>

            <div class="mb-3">
                <label for="dt_modified_date" class="form-label">Date</label>
                <input type="date" name="dt_modified_date" class="form-control" id="dt_modified_date" value="{{ $document->dt_modified_date }}">
            </div>

            <div class="mb-3">
                <label for="doctype_id" class="form-label">Type</label>
                <select id="doctype_id" name="doctype_id" class="form-select">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $document->doctype_id == $type->id ? 'selected' : '' }}>{{ $type->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="iso_id" class="form-label">ISO</label>
                <select id="iso_id" name="iso_id" class="form-select">
                    @foreach ($isos as $iso)
                        <option value="{{ $iso->id }}" {{ $document->iso_id == $iso->id ? 'selected' : '' }}>{{ $iso->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dep_terkait" class="form-label">Departement Terkait</label>
                <input type="text" name="dep_terkait" class="form-control" id="dep_terkait" value="{{$document->dep_terkait}}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
