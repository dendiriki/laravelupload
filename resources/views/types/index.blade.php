@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Types</h1>

        <a href="{{ route('types.create') }}" class="btn btn-primary mb-3">Create New Type</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th>Company</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->description }}</td>
                        <td>{{ $type->createdBy->username }}</td>
                        <td>{{ $type->modifiedBy->username }}</td>
                        <td>{{ $type->company->short }}</td>
                        <td>{{ $type->dt_created_date }}</td>
                        <td>{{ $type->dt_modified_date }}</td>
                        <td>
                            <a href="{{ route('types.edit', $type->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <form action="{{ route('types.destroy', $type->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Ensure this data has no relationships with other tables. Deleting related data will cause errors. Are you sure you want to delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
