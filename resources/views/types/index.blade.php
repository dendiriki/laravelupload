@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">List of Types</h2>

        <a href="{{ route('types.create') }}" class="btn btn-primary mb-3">Create New Type</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Short Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->description }}</td>
                        <td>{{ $type->short }}</td>
                        <td>{{ $type->dt_created_date }}</td>
                        <td>
                            <!-- Tambahkan tombol aksi jika diperlukan, seperti edit atau delete -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
