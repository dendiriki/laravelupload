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
                    <th>Date Created</th>
                    <th>Date Modified</th>
                    <th>Created By</th>
                    <th>Action</th> <!-- Tambah kolom untuk Action -->
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->description }}</td>
                        <td>{{ $document->type->short }}</td>
                        <td>{{ $document->iso->description }}</td>
                        <td>{{ $document->dt_created_date }}</td>
                        <td>{{ $document->dt_modified_date }}</td>
                        <td>{{ $document->createdBy->username }}</td>
                        <td>
                            <a href="{{ route('documents.edit', ['id' => $document->id]) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('documents.destroy', ['id' => $document->id]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
