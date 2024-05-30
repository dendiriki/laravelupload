<!-- resources/views/tiket/register_document.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Register Document</h2>
        <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="document_name">Document Name</label>
                <input type="text" class="form-control mb-3 @error('document_name') is-invalid @enderror" id="document_name" name="document_name">
                @error('document_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control mb-3 @error('description') is-invalid @enderror" id="description" name="description" rows="4"></textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="document_file">Document File</label>
                <br>
                <input type="file" class="form-control-file mt-3 mb-3 @error('document_file') is-invalid @enderror" id="document_file" name="document_file">
                @error('document_file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <input type="hidden" name="document_status" value="{{ $document_status }}">
            <input type="hidden" name="document_note" value="{{ $document_note }}">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
