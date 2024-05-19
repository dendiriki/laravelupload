<!-- resources/views/tiket/register_document.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Register Document</h2>
        <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="document_name">Document Name</label>
                <input type="text" class="form-control mb-3" id="document_name" name="document_name">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control mb-3" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="cover_file">Cover File</label>
                <br>
                <input type="file" class="form-control-file mt-3 mb-3" id="cover_file" name="cover_file">
            </div>

            <div class="form-group">
                <label for="document_file">Document File</label>
                <br>
                <input type="file" class="form-control-file mt-3 mb-3" id="document_file" name="document_file">
            </div>

            <div class="form-group">
                <label for="record_file">Record File</label>
                <br>
                <input type="file" class="form-control-file mt-3 mb-3" id="record_file" name="record_file">
            </div>

            <div class="form-group">
                <label for="attachment_file">Attachment File</label>
                <br>
                <input type="file" class="form-control-file mt-3 mb-3" id="attachment_file" name="attachment_file">
            </div>

            <input type="hidden" name="document_status" value="{{ $document_status }}">
            <input type="hidden" name="document_note" value="{{ $document_note }}">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
