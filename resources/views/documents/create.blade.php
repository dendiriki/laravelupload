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

        @if (session('customError'))
            <div class="alert alert-warning">
                {{ session('customError') }}
            </div>
        @endif

        <form action="{{ route('document.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="description" class="form-label">Name Doc</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" value="{{ old('description') }}">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="doc_name" class="form-label">Nomer Doc</label>
                <input type="text" name="doc_name" class="form-control @error('doc_name') is-invalid @enderror" id="doc_name" value="{{ old('doc_name') }}">
                @error('doc_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dt_modified_date" class="form-label">Date</label>
                <input type="date" name="dt_modified_date" class="form-control @error('dt_modified_date') is-invalid @enderror" id="dt_modified_date" value="{{ old('dt_modified_date') }}">
                @error('dt_modified_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="doctype_id" class="form-label">Type</label>
                <select id="doctype_id" name="doctype_id" class="form-select @error('doctype_id') is-invalid @enderror">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('doctype_id') == $type->id ? 'selected' : '' }}>{{ $type->short }}</option>
                    @endforeach
                </select>
                @error('doctype_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="iso_id" class="form-label">ISO</label>
                <select id="iso_id" name="iso_id" class="form-select @error('iso_id') is-invalid @enderror">
                    @foreach ($isos as $iso)
                        <option value="{{ $iso->id }}" {{ old('iso_id') == $iso->id ? 'selected' : '' }}>{{ $iso->description }}</option>
                    @endforeach
                </select>
                @error('iso_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dep_terkait" class="form-label">Departement Terkait</label>
                <select id="dep_terkait" name="dep_terkait" class="form-select @error('dep_terkait') is-invalid @enderror">
                    @foreach ($deps as $dep)
                        <option value="{{ $dep->short }}" {{ old('dep_terkait') == $dep->short ? 'selected' : '' }}>{{ $dep->short }}</option>
                    @endforeach
                </select>
                @error('dep_terkait')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
