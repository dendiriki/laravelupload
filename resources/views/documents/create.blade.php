@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Create Doc PDF</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="description" class="form-label">Name Doc</label>
                <input type="text" name="description" class="form-control" id="description">
            </div>

            <div class="mb-3">
                <label for="doc_name" class="form-label">Nomer Doc</label>
                <input type="text" name="doc_name" class="form-control @error('doc_name') is-invalid @enderror" id="doc_name">
                @error('doc_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dt_modified_date" class="form-label">Date</label>
                <input type="date" name="dt_modified_date" class="form-control" id="dt_modified_date">
            </div>

            <div class="mb-3">
                <label for="doctype_id" class="form-label">Type</label>
                <select id="doctype_id" name="doctype_id" class="form-select">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->short }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="iso_id" class="form-label">ISO</label>
                <select id="iso_id" name="iso_id" class="form-select">
                    @foreach ($isos as $iso)
                        <option value="{{ $iso->id }}">{{ $iso->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dep_terkait" class="form-label">Departement Terkait</label>
                <select id="dep_terkait" name="dep_terkait" class="form-select">
                    @foreach ($deps as $dep)
                        <option value="{{ $dep->short }}">{{ $dep->short }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
