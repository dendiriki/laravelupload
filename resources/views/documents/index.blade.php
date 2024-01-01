@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Documents</h2>
        <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Create New Document</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>ISO</th>
                    <th>Date Modified</th>
                    <th>Created By</th>
                    <th>Company</th>
                    <th>Path</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->description }}</td>
                        <td>{{ $document->type->description }}</td>
                        <td>{{ $document->iso->description }}</td>
                        <td>{{ $document->dt_modified_date }}</td>
                        <td>{{ $document->createdBy->username }}</td>
                        <td>{{ $document->company->short }}</td>
                        <td>{{ $document->path }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
